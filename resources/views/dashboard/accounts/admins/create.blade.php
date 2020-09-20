<x-layout :title="trans('admins.actions.create')" :breadcrumbs="['dashboard.admins.create']">
    {{ BsForm::resource('admins')->post(route('dashboard.admins.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('admins.actions.create'))

        @include('dashboard.accounts.admins.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('admins.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>