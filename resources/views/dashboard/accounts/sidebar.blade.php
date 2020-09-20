@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\User::class])
    @slot('url', '#')
    @slot('name', trans('users.plural'))
    @slot('active', request()->routeIs('*admins*') || request()->routeIs('*customers*'))
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('admins.plural'),
            'url' => route('dashboard.admins.index'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Admin::class],
            'active' => request()->routeIs('*admins*'),
        ],
        [
            'name' => trans('customers.plural'),
            'url' => route('dashboard.customers.index'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Customer::class],
            'active' => request()->routeIs('*customers*'),
        ],
    ])
@endcomponent
