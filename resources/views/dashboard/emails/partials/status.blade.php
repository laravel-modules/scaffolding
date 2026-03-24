@php
    $class = match($status) {
        \App\Emails\Enums\EmailStatus::QUEUED => 'secondary',
        \App\Emails\Enums\EmailStatus::SENDING => 'info',
        \App\Emails\Enums\EmailStatus::SENT => 'success',
        \App\Emails\Enums\EmailStatus::FAILED => 'danger',
        default => 'light',
    };
@endphp

<span class="badge badge-{{ $class }}">
    {{ $status->label() }}
</span>
