@props([
    'date' // Expecting \Carbon\Carbon|null
])

@if ($date)
    <time
        datetime="{{ $date->toISOString() }}"
        title="{{ $date->toDayDateTimeString() }}"
    >
        {{ $date->diffForHumans() }}
    </time>
@else
    <span class="text-muted">—</span>
@endif
