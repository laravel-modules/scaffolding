<?php

namespace App\Emails\Jobs;

use App\Emails\Contracts\HasEmailTemplateContract;
use App\Emails\Enums\EmailStatus;
use App\Emails\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBatchEmailsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public int $tries = 5;

    public int $emailsPerDay = 100;

    /**
     * @param  HasEmailTemplateContract[]  $emails
     */
    public function __construct(
        public array|Collection $emails,
        public ?string $subject = null,
        public ?string $content = null,
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        if (empty($this->emails)) {
            return;
        }

        $interval = intdiv(86400, $this->emailsPerDay);

        foreach ($this->emails as $index => $model) {

            $email = Email::query()->create([
                'model_type' => $model->getMorphClass(),
                'model_id' => $model->getKey(),
                'email' => $model->getEmailAddress(),
                'subject' => $model->applyEmailReplacements($this->subject),
                'content' => $model->applyEmailReplacements($this->content),
                'status' => EmailStatus::QUEUED,
            ]);

            SendSingleEmailJob::dispatch($model, $email)
                ->delay(now()->addSeconds($interval * $index))
                ->onQueue('emails');
        }
    }

    public function uniqueId(): string
    {
        return 'send-batch-emails-singleton';
    }
}
