@extends('layouts.dashboard', ['title' => $user->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.edit', $user])

        {{ BsForm::resource('users')->putModel($user, route('dashboard.users.update', $user)) }}
        @component('Template::components.box')
            @slot('title', trans('users.actions.edit'))

            @include('dashboard.users.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('users.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
