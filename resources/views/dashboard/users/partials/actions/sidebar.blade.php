@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\User::class])
    @slot('url', route('dashboard.users.index'))
    @slot('name', trans('users.plural'))
    @slot('routeActive', '*users*')
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('users.actions.list'),
            'url' => route('dashboard.users.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\User::class],
            'routeActive' => '*users.index',
        ],
        [
            'name' => trans('users.actions.create'),
            'url' => route('dashboard.users.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\User::class],
            'routeActive' => '*users.create',
        ],
    ])
@endcomponent
