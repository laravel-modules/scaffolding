@if(method_exists($supervisor, 'trashed') && $supervisor->trashed())
    @can('view', $supervisor)
        <a href="{{ route('dashboard.supervisors.trashed.show', $supervisor) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@else
    @can('view', $supervisor)
        <a href="{{ route('dashboard.supervisors.show', $supervisor) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@endif