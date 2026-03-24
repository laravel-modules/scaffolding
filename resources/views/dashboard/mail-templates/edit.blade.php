<x-layout :title="$mailTemplate->name" :breadcrumbs="['dashboard.mail-templates.edit', $mailTemplate]">
    {{ BsForm::resource('mail-templates')->putModel($mailTemplate, route('dashboard.mail-templates.update', $mailTemplate)) }}
    @component('dashboard::components.box')
        @slot('title', __('mail-templates.actions.edit'))

        @include('dashboard.mail-templates.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(__('mail-templates.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>