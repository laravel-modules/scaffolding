@can('viewAnyTrash', \App\Models\MailTemplate::class)
    <a href="{{ route('dashboard.mail-templates.trashed') }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('mail-templates.trashed')
    </a>
@endcan
