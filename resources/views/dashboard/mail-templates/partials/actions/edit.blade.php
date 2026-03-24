@can('update', $mailTemplate)
    <a href="{{ route('dashboard.mail-templates.edit', $mailTemplate) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa fa-fw fa-edit"></i>
    </a>
@endcan
