@extends('layout::master', ['title' => trans('accounts::admins.actions.create')])
@section('content')
    @component('layout::components.page')
        @slot('title', trans('accounts::admins.plural'))
        @slot('breadcrumbs', ['dashboard.admins.create'])

        {{ BsForm::resource('accounts::admins')->post(route('dashboard.admins.store'), ['files' => true]) }}
        @component('layout::components.box')
            @slot('title', trans('accounts::admins.actions.create'))

            @include('accounts::admins.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('accounts::admins.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection

