@extends('layouts.dashboard', ['title' => trans('admins.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('admins.plural'))
        @slot('breadcrumbs', ['dashboard.admins.index'])

        @component('Template::components.table-box')
            @slot('title', trans('admins.actions.list'))
            @slot('tools')
                @include('dashboard.admins.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('admins.attributes.name')</th>
                <th>@lang('admins.attributes.email')</th>
                <th style="width: 160px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($admins as $admin)
            <tr>
                <td>
                    <a href="{{ route('dashboard.admins.show', $admin) }}" class="text-decoration-none">
                        <img src="{{ $admin->getAvatar() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2">
                        {{ $admin->name }}
                    </a>
                </td>
                <td>
                    {{ $admin->email }}
                </td>
                <td>
                    @include('dashboard.admins.partials.actions.show')
                    @include('dashboard.admins.partials.actions.edit')
                    @include('dashboard.admins.partials.actions.delete')
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

    @endcomponent
@endsection
