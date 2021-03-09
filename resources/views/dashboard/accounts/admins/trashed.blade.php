<x-layout :title="trans('admins.trashed')" :breadcrumbs="['dashboard.admins.trashed']">
    @include('dashboard.accounts.admins.partials.filter')

    @component('dashboard::components.table-box')

        @slot('title')
            @lang('admins.actions.list') ({{ count_formatted($admins->total()) }})
        @endslot

        <thead>
        <tr>
            <th colspan="100">
                <x-check-all-force-delete
                        type="{{ \App\Models\Admin::class }}"
                        :resource="trans('admins.plural')"></x-check-all-force-delete>
                <x-check-all-restore
                        type="{{ \App\Models\Admin::class }}"
                        :resource="trans('admins.plural')"></x-check-all-restore>
            </th>
        </tr>
        <tr>
            <th>
                <x-check-all></x-check-all>
            </th>
            <th>@lang('admins.attributes.name')</th>
            <th class="d-none d-md-table-cell">@lang('admins.attributes.email')</th>
            <th>@lang('admins.attributes.phone')</th>
            <th>@lang('admins.attributes.created_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($admins as $admin)
            <tr>
                <td>
                    <x-check-all-item :model="$admin"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.admins.trashed.show', $admin) }}"
                       class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.accounts.admins.partials.flags.svg')
                            </span>
                        <img src="{{ $admin->getAvatar() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2">
                        {{ $admin->name }}
                    </a>
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $admin->email }}
                </td>
                <td>{{ $admin->phone }}</td>
                <td>{{ $admin->created_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.accounts.admins.partials.actions.show')
                    @include('dashboard.accounts.admins.partials.actions.restore')
                    @include('dashboard.accounts.admins.partials.actions.forceDelete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('admins.empty')</td>
            </tr>
        @endforelse

        @if($admins->hasPages())
            @slot('footer')
                {{ $admins->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
