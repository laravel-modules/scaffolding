@if(method_exists($mailTemplate, 'trashed') && $mailTemplate->trashed())
    @can('view', $mailTemplate)
        <a href="{{ route('dashboard.mail-templates.trashed.show', $mailTemplate) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@else
    @can('view', $mailTemplate)
        <a href="{{ route('dashboard.mail-templates.show', $mailTemplate) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@endif