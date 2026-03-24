@include('dashboard.errors')

@multilingualFormTabs
{{ BsForm::text('name') }}
{{ BsForm::text('subject') }}
{{ BsForm::textarea('content')->attribute('class', 'textarea') }}
@endMultilingualFormTabs

<br>
<hr>
<div>
    <b>{{ __('mail-templates.variables') }}</b>

    <ul>
        @foreach(\App\Models\MailTemplate::variables($mailTemplate->model_type ?? request('model_type')) as $variable)
            <li>{{ $variable }}</li>
        @endforeach
    </ul>
</div>
