<x-layout :title="$supervisor->name" :breadcrumbs="['dashboard.supervisors.show', $supervisor]">
    @component('dashboard::components.box')
        @slot('bodyClass', 'p-0')

        <table class="table table-striped table-middle">
            <tbody>
            <tr>
                <th width="200">@lang('supervisors.attributes.name')</th>
                <td>{{ $supervisor->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('supervisors.attributes.email')</th>
                <td>{{ $supervisor->email }}</td>
            </tr>
            <tr>
                <th width="200">@lang('supervisors.attributes.phone')</th>
                <td>
                    @include('dashboard.accounts.supervisors.partials.flags.phone')
                </td>
            </tr>
            <tr>
                <th width="200">@lang('supervisors.attributes.avatar')</th>
                <td>
                    @if($supervisor->getFirstMedia('avatars'))
                        <file-preview :media="{{ $supervisor->getMediaResource('avatars') }}"></file-preview>
                    @else
                        <img src="{{ $supervisor->getAvatar() }}"
                             class="img img-size-64"
                             alt="{{ $supervisor->name }}">
                    @endif
                </td>
            </tr>
            </tbody>
        </table>

        @slot('footer')
            @include('dashboard.accounts.supervisors.partials.actions.impersonate')
            @include('dashboard.accounts.supervisors.partials.actions.edit')
            @include('dashboard.accounts.supervisors.partials.actions.delete')
            @include('dashboard.accounts.supervisors.partials.actions.restore')
            @include('dashboard.accounts.supervisors.partials.actions.forceDelete')
        @endslot
    @endcomponent
</x-layout>
