@extends('layouts.dashboard', ['title' => $user->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.show', $user])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('users.attributes.name')</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('users.attributes.email')</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('users.attributes.type')</th>
                            <td>@include('dashboard.users.partials.flags.type')</td>
                        </tr>
                        <tr>
                            <th>@lang('users.attributes.avatar')</th>
                            <td>
                                <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
                            </td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.users.partials.actions.edit')
                        @include('dashboard.users.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

    @endcomponent
@endsection
