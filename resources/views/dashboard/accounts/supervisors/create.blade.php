<x-layout :title="trans('supervisors.actions.create')" :breadcrumbs="['dashboard.supervisors.create']">
    {{ BsForm::resource('supervisors')->post(route('dashboard.supervisors.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('supervisors.actions.create'))

        @include('dashboard.accounts.supervisors.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('supervisors.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>