@extends('dashboard::layouts.master', ['title' => trans('accounts::users.actions.create')])
@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', trans('accounts::users.plural'))
        @slot('breadcrumbs', ['dashboard.users.create'])

        {{ BsForm::resource('accounts::users')->post(route('dashboard.users.store')) }}
        @component('dashboard::layouts.components.box')
            @slot('title', trans('accounts::users.actions.create'))

            @include('accounts::partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('accounts::users.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
