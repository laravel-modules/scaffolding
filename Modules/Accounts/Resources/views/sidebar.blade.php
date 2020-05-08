@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \Modules\Accounts\Entities\User::class])
    @slot('url', '#')
    @slot('name', trans('accounts::users.plural'))
    @slot('isActive', request()->routeIs('accounts*'))
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('accounts::admins.plural'),
            'url' => route('dashboard.admins.index'),
            'can' => ['ability' => 'create', 'model' => \Modules\Accounts\Entities\Admin::class],
            'isActive' => request()->routeIs('*admins*'),
        ],
        [
            'name' => trans('accounts::customers.plural'),
            'url' => route('dashboard.customers.index'),
            'can' => ['ability' => 'create', 'model' => \Modules\Accounts\Entities\Customer::class],
            'isActive' => request()->routeIs('*customers*'),
        ],
    ])
@endcomponent
