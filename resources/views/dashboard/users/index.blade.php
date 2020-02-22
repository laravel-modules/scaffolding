@extends('layouts.dashboard', ['title' => trans('users.plural')])

@section('content')
    @component('Template::components.page')
        @slot('title', trans('users.plural'))
        @slot('breadcrumbs', ['dashboard.users.index'])

        @component('Template::components.table-box')
            @slot('title', trans('users.actions.list'))
            @slot('tools')
                @include('dashboard.users.partials.actions.filter')
                @include('dashboard.users.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('users.attributes.name')</th>
                <th class="d-none d-md-table-cell">@lang('users.attributes.email')</th>
                <th class="d-none d-md-table-cell">@lang('users.attributes.type')</th>
                <th style="width: 160px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('dashboard.users.show', $user) }}"
                           class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.users.partials.flags.svg')
                            </span>
                            <img src="{{ $user->getAvatar() }}"
                                 alt="Product 1"
                                 class="img-circle img-size-32 mr-2">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="d-none d-md-table-cell">
                        {{ $user->email }}
                    </td>
                    <td class="d-none d-md-table-cell">
                        @include('dashboard.users.partials.flags.type')
                    </td>
                    <td style="width: 160px">
                        @include('dashboard.users.partials.actions.show')
                        @include('dashboard.users.partials.actions.edit')
                        @include('dashboard.users.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('users.empty')</td>
                </tr>
            @endforelse

            @if($users->hasPages())
                @slot('footer')
                    {{ $users->links() }}
                @endslot
            @endif
        @endcomponent

    @endcomponent
@endsection
