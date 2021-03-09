@if($admin)
    @if(method_exists($admin, 'trashed') && $admin->trashed())
        <a href="{{ route('dashboard.admins.trashed.show', $admin) }}" class="text-decoration-none text-ellipsis">
            {{ $admin->name }}
        </a>
    @else
        <a href="{{ route('dashboard.admins.show', $admin) }}" class="text-decoration-none text-ellipsis">
            {{ $admin->name }}
        </a>
    @endif
@else
    ---
@endif