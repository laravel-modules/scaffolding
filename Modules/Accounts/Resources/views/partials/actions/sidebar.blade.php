@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \Modules\Accounts\Entities\User::class])
    @slot('url', route('dashboard.users.index'))
    @slot('name', trans('accounts::users.plural'))
    @slot('routeActive', '*users*')
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('accounts::users.actions.list'),
            'url' => route('dashboard.users.index'),
            'can' => ['ability' => 'viewAny', 'model' => \Modules\Accounts\Entities\User::class],
            'routeActive' => '*users.index',
        ],
        [
            'name' => trans('accounts::users.actions.create'),
            'url' => route('dashboard.users.create'),
            'can' => ['ability' => 'create', 'model' => \Modules\Accounts\Entities\User::class],
            'routeActive' => '*users.create',
        ],
    ])
@endcomponent
