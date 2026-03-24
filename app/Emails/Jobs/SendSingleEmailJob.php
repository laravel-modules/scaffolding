<?php

namespace App\Emails\Jobs;

use App\Emails\Contracts\HasEmailTemplateContract;
use App\Emails\Enums\EmailStatus;
use App\Emails\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendSingleEmailJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(
        public HasEmailTemplateContract $model,
        public Email $email,
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {

            $this->email->forceFill(['status' => EmailStatus::SENDING])->save();

            $this->model->sendEmail(
                subject: $this->email->subject,
                content: $this->email->content,
            );

            $this->email->forceFill(['status' => EmailStatus::SENT])->save();

        } catch (\Throwable $e) {

            $this->email->forceFill(['status' => EmailStatus::FAILED])->save();

            throw $e;
        }
    }
}
