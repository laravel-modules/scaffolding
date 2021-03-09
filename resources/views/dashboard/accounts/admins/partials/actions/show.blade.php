@if(method_exists($admin, 'trashed') && $admin->trashed())
    @can('view', $admin)
        <a href="{{ route('dashboard.admins.trashed.show', $admin) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@else
    @can('view', $admin)
        <a href="{{ route('dashboard.admins.show', $admin) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@endif