<x-layout :title="$admin->name" :breadcrumbs="['dashboard.admins.edit', $admin]">
    {{ BsForm::resource('admins')->putModel($admin, route('dashboard.admins.update', $admin), ['files' => true]) }}
    @component('dashboard::components.box')
        @slot('title', trans('admins.actions.edit'))

        @include('dashboard.accounts.admins.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('admins.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
