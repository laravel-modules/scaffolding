@can('viewAnyTrash', \App\Models\Feedback::class)
    <a href="{{ route('dashboard.feedback.trashed') }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('feedback.trashed')
    </a>
@endcan
