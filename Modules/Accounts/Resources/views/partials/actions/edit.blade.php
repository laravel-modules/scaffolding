@can('update', $user)
    <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa fa-fw fa-user-edit"></i>
    </a>
@endcan
