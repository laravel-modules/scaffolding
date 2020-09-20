<x-layout :title="trans('admins.plural')" :breadcrumbs="['dashboard.admins.index']">
    @include('dashboard.accounts.admins.partials.filter')
    @component('dashboard::components.table-box')

        @slot('title', trans('admins.actions.list'))

        @slot('tools')
            @include('dashboard.accounts.admins.partials.actions.create')
        @endslot

        <thead>
        <tr>
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
                    <a href="{{ route('dashboard.admins.show', $admin) }}"
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
                    @include('dashboard.accounts.admins.partials.actions.edit')
                    @include('dashboard.accounts.admins.partials.actions.delete')
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

