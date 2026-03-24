<x-layout :title="__('mail-templates.actions.create')" :breadcrumbs="['dashboard.mail-templates.create']">
    {{ BsForm::resource('mail-templates')->post(route('dashboard.mail-templates.store', request()->only('model_type'))) }}
    @component('dashboard::components.box')
        @slot('title')
            {{ __('mail-templates.actions.create') }} ({{ data_get(\App\Models\MailTemplate::types(), request('model_type')) }})
        @endslot

        @include('dashboard.mail-templates.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(__('mail-templates.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
