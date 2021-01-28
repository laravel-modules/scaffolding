@can('create', \App\Models\Supervisor::class)
    <a href="{{ route('dashboard.supervisors.create', request()->only('type')) }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('supervisors.actions.create')
    </a>
@endcan
