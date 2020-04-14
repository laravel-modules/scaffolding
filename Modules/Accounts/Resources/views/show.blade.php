@extends('dashboard::layouts.master', ['title' => $user->name])
@section('content')
    @component('dashboard::layouts.components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.show', $user])

        <div class="row">
            <div class="col-md-12">
                @component('dashboard::layouts.components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('accounts::users.attributes.name')</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('accounts::users.attributes.email')</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('accounts::users.attributes.type')</th>
                            <td>@include('accounts::partials.flags.type')</td>
                        </tr>
                        <tr>
                            <th>@lang('accounts::users.attributes.avatar')</th>
                            <td>
                                <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
                            </td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('accounts::partials.actions.edit')
                        @include('accounts::partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

    @endcomponent
@endsection
