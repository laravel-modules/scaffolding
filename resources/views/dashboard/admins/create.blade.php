@extends('layouts.dashboard', ['title' => trans('admins.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('admins.plural'))
        @slot('breadcrumbs', ['dashboard.admins.create'])

        {{ BsForm::resource('admins')->post(route('dashboard.admins.store')) }}
        @component('Template::components.box')
            @slot('title', trans('admins.actions.create'))

            @include('dashboard.admins.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('admins.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
