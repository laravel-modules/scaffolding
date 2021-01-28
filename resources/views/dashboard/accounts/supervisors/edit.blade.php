<x-layout :title="$supervisor->name" :breadcrumbs="['dashboard.supervisors.edit', $supervisor]">
    {{ BsForm::resource('supervisors')->putModel($supervisor, route('dashboard.supervisors.update', $supervisor), ['files' => true]) }}
    @component('dashboard::components.box')
        @slot('title', trans('supervisors.actions.edit'))

        @include('dashboard.accounts.supervisors.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('supervisors.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
