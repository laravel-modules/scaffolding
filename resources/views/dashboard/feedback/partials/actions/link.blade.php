@if($feedback)
    @if(method_exists($feedback, 'trashed') && $feedback->trashed())
        <a href="{{ route('dashboard.feedback.trashed.show', $feedback) }}" class="text-decoration-none text-ellipsis">
            {{ $feedback->name }}
        </a>
    @else
        <a href="{{ route('dashboard.feedback.show', $feedback) }}" class="text-decoration-none text-ellipsis">
            {{ $feedback->name }}
        </a>
    @endif
@else
    ---
@endif