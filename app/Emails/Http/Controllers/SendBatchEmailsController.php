<?php

namespace App\Emails\Http\Controllers;

use App\Emails\Contracts\HasEmailTemplateContract;
use App\Emails\Jobs\SendBatchEmailsJob;
use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laraeast\LaravelSettings\Facades\Settings;

class SendBatchEmailsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'model' => ['required', 'string'],
            'items' => ['required', 'array'],
            'mail_template_id' => ['required', 'exists:mail_templates,id'],
        ]);

        $modelClass = $data['model'];

        if (! in_array(HasEmailTemplateContract::class, class_implements($modelClass))) {
            throw ValidationException::withMessages([
                'model' => [__('emails.errors.not_email', ['model' => $modelClass])],
            ]);
        }

        $template = MailTemplate::find($request->mail_template_id);

        $emailsPerDay = Settings::get('emails_per_day', 100);

        SendBatchEmailsJob::dispatch(
            $modelClass::whereIn('id', $request->input('items', []))->get(),
            $template->subject,
            $template->content,
            $emailsPerDay,
        );

        flash()->success(trans('emails.messages.sending', [
            'type' => $request->input('resource'),
        ]));

        return back();
    }
}
