<x-layout :title="$customer->name" :breadcrumbs="['dashboard.customers.show', $customer]">
    @component('dashboard::components.box')
        @slot('bodyClass', 'p-0')

        <table class="table table-striped table-middle">
            <tbody>
            <tr>
                <th width="200">@lang('customers.attributes.name')</th>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('customers.attributes.email')</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th width="200">@lang('customers.attributes.phone')</th>
                <td>{{ $customer->phone }}</td>
            </tr>
            <tr>
                <th width="200">@lang('customers.attributes.avatar')</th>
                <td>
                    <img src="{{ $customer->getAvatar() }}"
                         class="img img-size-64"
                         alt="{{ $customer->name }}">
                </td>
            </tr>
            </tbody>
        </table>

        @slot('footer')
            @include('dashboard.accounts.customers.partials.actions.edit')
            @include('dashboard.accounts.customers.partials.actions.delete')
        @endslot
    @endcomponent
</x-layout>
