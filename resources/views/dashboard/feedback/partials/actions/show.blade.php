@if(method_exists($feedback, 'trashed') && $feedback->trashed())
    @can('view', $feedback)
        <a href="{{ route('dashboard.feedback.trashed.show', $feedback) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@else
    @can('view', $feedback)
        <a href="{{ route('dashboard.feedback.show', $feedback) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@endif