@if($mailTemplate)
    @if(method_exists($mailTemplate, 'trashed') && $mailTemplate->trashed())
        <a href="{{ route('dashboard.mail-templates.trashed.show', $mailTemplate) }}" class="text-decoration-none text-ellipsis">
            {{ $mailTemplate->name }}
        </a>
    @else
        <a href="{{ route('dashboard.mail-templates.show', $mailTemplate) }}" class="text-decoration-none text-ellipsis">
            {{ $mailTemplate->name }}
        </a>
    @endif
@else
    ---
@endif