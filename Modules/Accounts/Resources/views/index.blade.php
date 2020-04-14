@extends('dashboard::layouts.master', ['title' => trans('accounts::users.plural')])

@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', trans('accounts::users.plural'))
        @slot('breadcrumbs', ['dashboard.users.index'])

        @component('dashboard::layouts.components.table-box')
            @slot('title', trans('accounts::users.actions.list'))
            @slot('tools')
                @include('accounts::partials.actions.filter')
                @include('accounts::partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('accounts::users.attributes.name')</th>
                <th class="d-none d-md-table-cell">@lang('accounts::users.attributes.email')</th>
                <th class="d-none d-md-table-cell">@lang('accounts::users.attributes.type')</th>
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
                            @include('accounts::partials.flags.svg')
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
                        @include('accounts::partials.flags.type')
                    </td>
                    <td style="width: 160px">
                        @include('accounts::partials.actions.show')
                        @include('accounts::partials.actions.edit')
                        @include('accounts::partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('accounts::users.empty')</td>
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
