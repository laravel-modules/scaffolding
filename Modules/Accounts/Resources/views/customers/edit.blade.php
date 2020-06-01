@extends('layout::master', ['title' => $customer->name])
@section('content')
    @component('layout::components.page')
        @slot('title', $customer->name)
        @slot('breadcrumbs', ['dashboard.customers.edit', $customer])

        {{ BsForm::resource('accounts::customers')->putModel($customer, route('dashboard.customers.update', $customer), ['files' => true]) }}
        @component('layout::components.box')
            @slot('title', trans('accounts::customers.actions.edit'))

            @include('accounts::customers.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('accounts::customers.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
