<x-layout :title="trans('supervisors.trashed')" :breadcrumbs="['dashboard.supervisors.trashed']">
    @include('dashboard.accounts.supervisors.partials.filter')

    @component('dashboard::components.table-box')

        @slot('title')
            @lang('supervisors.actions.list') ({{ count_formatted($supervisors->total()) }})
        @endslot

        <thead>
        <tr>
            <th colspan="100">
                <x-check-all-force-delete
                        type="{{ \App\Models\Supervisor::class }}"
                        :resource="trans('supervisors.plural')"></x-check-all-force-delete>
                <x-check-all-restore
                        type="{{ \App\Models\Supervisor::class }}"
                        :resource="trans('supervisors.plural')"></x-check-all-restore>
            </th>
        </tr>
        <tr>
            <th>
                <x-check-all></x-check-all>
            </th>
            <th>@lang('supervisors.attributes.name')</th>
            <th class="d-none d-md-table-cell">@lang('supervisors.attributes.email')</th>
            <th>@lang('supervisors.attributes.phone')</th>
            <th>@lang('supervisors.attributes.created_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($supervisors as $supervisor)
            <tr>
                <td>
                    <x-check-all-item :model="$supervisor"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.supervisors.trashed.show', $supervisor) }}"
                       class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.accounts.supervisors.partials.flags.svg')
                            </span>
                        <img src="{{ $supervisor->getAvatar() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2">
                        {{ $supervisor->name }}
                    </a>
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $supervisor->email }}
                </td>
                <td>
                    @include('dashboard.accounts.supervisors.partials.flags.phone')
                </td>
                <td>{{ $supervisor->created_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.accounts.supervisors.partials.actions.show')
                    @include('dashboard.accounts.supervisors.partials.actions.restore')
                    @include('dashboard.accounts.supervisors.partials.actions.forceDelete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('supervisors.empty')</td>
            </tr>
        @endforelse

        @if($supervisors->hasPages())
            @slot('footer')
                {{ $supervisors->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
