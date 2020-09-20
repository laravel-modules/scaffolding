<x-layout :title="trans('customers.plural')" :breadcrumbs="['dashboard.customers.index']">
    @include('dashboard.accounts.customers.partials.filter')

    @component('dashboard::components.table-box')

        @slot('title', trans('customers.actions.list'))

        @slot('tools')
            @include('dashboard.accounts.customers.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('customers.attributes.name')</th>
            <th class="d-none d-md-table-cell">@lang('customers.attributes.email')</th>
            <th>@lang('customers.attributes.phone')</th>
            <th>@lang('customers.attributes.created_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($customers as $customer)
            <tr>
                <td>
                    <a href="{{ route('dashboard.customers.show', $customer) }}"
                       class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.accounts.customers.partials.flags.svg')
                            </span>
                        <img src="{{ $customer->getAvatar() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2">
                        {{ $customer->name }}
                    </a>
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $customer->email }}
                </td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->created_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.accounts.customers.partials.actions.show')
                    @include('dashboard.accounts.customers.partials.actions.edit')
                    @include('dashboard.accounts.customers.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('customers.empty')</td>
            </tr>
        @endforelse

        @if($customers->hasPages())
            @slot('footer')
                {{ $customers->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
