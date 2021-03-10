@can('viewAnyTrash', \App\Models\Admin::class)
    <a href="{{ route('dashboard.admins.trashed', request()->only('type')) }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('admins.trashed')
    </a>
@endcan
