@extends('layout::master', ['title' => $customer->name])
@section('content')
    @component('layout::components.page')
        @slot('title', $customer->name)
        @slot('breadcrumbs', ['dashboard.customers.show', $customer])

        @component('layout::components.box')
            @slot('bodyClass', 'p-0')

            <table class="table table-striped table-middle">
                <tbody>
                <tr>
                    <th width="200">@lang('accounts::customers.attributes.name')</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th width="200">@lang('accounts::customers.attributes.email')</th>
                    <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th width="200">@lang('accounts::customers.attributes.phone')</th>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <th width="200">@lang('accounts::customers.attributes.avatar')</th>
                    <td>
                        <img src="{{ $customer->getAvatar() }}"
                             class="img img-size-64"
                             alt="{{ $customer->name }}">
                    </td>
                </tr>
                </tbody>
            </table>

            @slot('footer')
                @include('accounts::customers.partials.actions.edit')
                @include('accounts::customers.partials.actions.delete')
            @endslot
        @endcomponent
    @endcomponent
@endsection
