@can('create', \App\Models\User::class)
    <a href="{{ route('dashboard.users.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('users.actions.create')
    </a>
@endcan
