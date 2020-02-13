@extends('layouts.dashboard', ['title' => $admin->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $admin->name)
        @slot('breadcrumbs', ['dashboard.admins.edit', $admin])

        {{ BsForm::resource('admins')->putModel($admin, route('dashboard.admins.update', $admin)) }}
        @component('Template::components.box')
            @slot('title', trans('admins.actions.edit'))

            @include('dashboard.admins.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('admins.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
