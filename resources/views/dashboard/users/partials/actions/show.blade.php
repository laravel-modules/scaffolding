@can('view', $user)
    <a href="{{ route('dashboard.users.show', $user) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
