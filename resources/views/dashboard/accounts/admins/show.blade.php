<x-layout :title="$admin->name" :breadcrumbs="['dashboard.admins.show', $admin]">
    @component('dashboard::components.box')
        @slot('bodyClass', 'p-0')

        <table class="table table-striped table-middle">
            <tbody>
            <tr>
                <th width="200">@lang('admins.attributes.name')</th>
                <td>{{ $admin->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('admins.attributes.email')</th>
                <td>{{ $admin->email }}</td>
            </tr>
            <tr>
                <th width="200">@lang('admins.attributes.phone')</th>
                <td>{{ $admin->phone }}</td>
            </tr>
            <tr>
                <th width="200">@lang('admins.attributes.avatar')</th>
                <td>
                    <img src="{{ $admin->getAvatar() }}"
                         class="img img-size-64"
                         alt="{{ $admin->name }}">
                </td>
            </tr>
            </tbody>
        </table>

        @slot('footer')
            @include('dashboard.accounts.admins.partials.actions.edit')
            @include('dashboard.accounts.admins.partials.actions.delete')
        @endslot
    @endcomponent
</x-layout>
