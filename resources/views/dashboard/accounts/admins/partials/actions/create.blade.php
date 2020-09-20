@can('create', \App\Models\Admin::class)
    <a href="{{ route('dashboard.admins.create', request()->only('type')) }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('admins.actions.create')
    </a>
@endcan
