@component('layout::components.sidebarItem')
    @slot('url', route('dashboard.home'))
    @slot('name', trans('dashboard::dashboard.home'))
    @slot('icon', 'fas fa-tachometer-alt')
    @slot('isActive', request()->routeIs('dashboard.home'))
@endcomponent

@include('accounts::sidebar')

