<?php

namespace App\Emails\Jobs;

use App\Emails\Contracts\HasEmailTemplateContract;
use App\Emails\Enums\EmailStatus;
use App\Emails\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Laraeast\LaravelSettings\Facades\Settings;

class SendBatchEmailsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public int $tries = 5;

    /**
     * @param  HasEmailTemplateContract[]  $emails
     */
    public function __construct(
        public array|Collection $emails,
        public ?string $subject = null,
        public ?string $content = null,
        public ?int $emailsPerDay = null,
    ) {
        $this->onQueue('emails');

        if (! $this->emailsPerDay) {
            $this->emailsPerDay = Settings::get('emails_per_day', 100);
        }
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
                'send_at' => now()->addSeconds($interval * $index),
            ]);

            SendSingleEmailJob::dispatch($model, $email)
                ->delay($email->send_at)
                ->onQueue('emails');
        }
    }

    public function uniqueId(): string
    {
        return 'send-batch-emails-singleton';
    }
}
