@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.home'))
    @slot('name', trans('dashboard.home'))
    @slot('icon', 'fas fa-tachometer-alt')
    @slot('active', request()->routeIs('dashboard.home'))
@endcomponent

@include('dashboard.accounts.sidebar')
@include('dashboard.settings.sidebar')
{{-- The sidebar of generated crud will set here: Don't remove this line --}}