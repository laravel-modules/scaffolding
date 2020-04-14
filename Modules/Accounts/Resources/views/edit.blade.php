@extends('dashboard::layouts.master', ['title' => $user->name])
@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.edit', $user])

        {{ BsForm::resource('accounts::users')->putModel($user, route('dashboard.users.update', $user)) }}
        @component('dashboard::layouts.components.box')
            @slot('title', trans('users.actions.edit'))

            @include('accounts::partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('accounts::users.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
