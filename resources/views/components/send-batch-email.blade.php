@props(['model'])

@php
$templates = \App\Models\MailTemplate::where('model_type', $model)->latest()->get()->pluck('name', 'id')->toArray();
@endphp
@if(! empty($templates) && in_array(\App\Emails\Contracts\HasEmailTemplateContract::class, class_implements($model)))
    <button class="btn btn-outline-primary btn-sm"
            data-checkbox=".item-checkbox"
            data-form="send-batch-email-selected-form"
            data-toggle="modal"
            data-target="#send-batch-email-selected-model">
        <i class="far fa-paper-plane"></i>
        {{ __('emails.actions.send') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="send-batch-email-selected-model" tabindex="-1" role="dialog"
         aria-labelledby="selected-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selected-modal-title">
                        {{ __('emails.actions.send') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.emails.batch', ['model' => $model]) }}"
                          id="send-batch-email-selected-form"
                          method="POST">
                        @csrf
                        {{ BsForm::select('mail_template_id')->options($templates)->label(__('mail-templates.select')) }}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        {{ __('emails.actions.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" form="send-batch-email-selected-form">
                        {{ __('emails.actions.confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

@endif
