@if($supervisor)
    @if(method_exists($supervisor, 'trashed') && $supervisor->trashed())
        <a href="{{ route('dashboard.supervisors.trashed.show', $supervisor) }}" class="text-decoration-none text-ellipsis">
            {{ $supervisor->name }}
        </a>
    @else
        <a href="{{ route('dashboard.supervisors.show', $supervisor) }}" class="text-decoration-none text-ellipsis">
            {{ $supervisor->name }}
        </a>
    @endif
@else
    ---
@endif