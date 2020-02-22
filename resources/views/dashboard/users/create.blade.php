@extends('layouts.dashboard', ['title' => trans('users.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('users.plural'))
        @slot('breadcrumbs', ['dashboard.users.create'])

        {{ BsForm::resource('users')->post(route('dashboard.users.store')) }}
        @component('Template::components.box')
            @slot('title', trans('users.actions.create'))

            @include('dashboard.users.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('users.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
