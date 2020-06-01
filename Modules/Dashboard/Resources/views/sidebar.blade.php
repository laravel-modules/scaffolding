@component('layout::components.sidebarItem')
    @slot('url', route('dashboard.home'))
    @slot('name', trans('dashboard::dashboard.home'))
    @slot('icon', 'fas fa-tachometer-alt')
    @slot('routeActive', 'dashboard.home')
@endcomponent

@include('accounts::sidebar')

