<x-layout :title="trans('customers.trashed')" :breadcrumbs="['dashboard.customers.trashed']">
    @include('dashboard.accounts.customers.partials.filter')

    @component('dashboard::components.table-box')

        @slot('title')
            @lang('customers.actions.list') ({{ count_formatted($customers->total()) }})
        @endslot

        <thead>
        <tr>
            <th colspan="100">
                <x-check-all-force-delete
                        type="{{ \App\Models\Customer::class }}"
                        :resource="trans('customers.plural')"></x-check-all-force-delete>
                <x-check-all-restore
                        type="{{ \App\Models\Customer::class }}"
                        :resource="trans('customers.plural')"></x-check-all-restore>
            </th>
        </tr>
        <tr>
            <th>
                <x-check-all></x-check-all>
            </th>
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
                    <x-check-all-item :model="$customer"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.customers.trashed.show', $customer) }}"
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
                <td>
                    @include('dashboard.accounts.customers.partials.flags.phone')
                </td>
                <td>{{ $customer->created_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.accounts.customers.partials.actions.show')
                    @include('dashboard.accounts.customers.partials.actions.restore')
                    @include('dashboard.accounts.customers.partials.actions.forceDelete')
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
