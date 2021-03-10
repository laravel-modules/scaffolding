@can('viewAnyTrash', \App\Models\Customer::class)
    <a href="{{ route('dashboard.customers.trashed', request()->only('type')) }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('customers.trashed')
    </a>
@endcan
