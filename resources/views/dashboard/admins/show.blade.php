@extends('layouts.dashboard', ['title' => $admin->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $admin->name)
        @slot('breadcrumbs', ['dashboard.admins.show', $admin])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('admins.attributes.name')</th>
                            <td>{{ $admin->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admins.attributes.email')</th>
                            <td>{{ $admin->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('admins.attributes.avatar')</th>
                            <td>
                                <img src="{{ $admin->getAvatar() }}" alt="{{ $admin->name }}">
                            </td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.admins.partials.actions.edit')
                        @include('dashboard.admins.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
        </div>

    @endcomponent
@endsection
