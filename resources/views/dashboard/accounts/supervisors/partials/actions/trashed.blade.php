@can('viewAnyTrash', \App\Models\Supervisor::class)
    <a href="{{ route('dashboard.supervisors.trashed', request()->only('type')) }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('supervisors.trashed')
    </a>
@endcan
