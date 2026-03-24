<?php

namespace App\Http\Controllers\Dashboard;

use App\Emails\Contracts\HasEmailTemplateContract;
use App\Emails\Jobs\SendBatchEmailsJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SendBatchEmailsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'model' => ['required', 'string'],
            'ids' => ['required', 'array'],
        ]);

        $modelClass = $data['model'];

        if (! in_array(HasEmailTemplateContract::class, class_implements($modelClass))) {
            throw ValidationException::withMessages([
                'model' => [__('emails.errors.not_email', ['model' => $modelClass])],
            ]);
        }

        SendBatchEmailsJob::dispatch(
            $modelClass::whereIn('id', $request->input('ids', []))->get(),
            'Test Subject',
            'Test Content Welcome %CUSTOMER_NAME%,',
        );

        flash()->success(trans('emails.messages.sending', [
            'type' => $request->input('resource'),
        ]));

        return back();
    }
}
