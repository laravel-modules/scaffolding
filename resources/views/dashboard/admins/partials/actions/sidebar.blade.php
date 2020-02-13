@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Admin::class])
    @slot('url', route('dashboard.admins.index'))
    @slot('name', trans('admins.plural'))
    @slot('routeActive', '*admins*')
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
            'name' => trans('admins.actions.list'),
            'url' => route('dashboard.admins.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Admin::class],
            'routeActive' => '*admins.index',
        ],
        [
            'name' => trans('admins.actions.create'),
            'url' => route('dashboard.admins.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Admin::class],
            'routeActive' => '*admins.create',
        ],
    ])
@endcomponent
