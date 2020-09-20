@can('create', \App\Models\Customer::class)
    <a href="{{ route('dashboard.customers.create', request()->only('type')) }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('customers.actions.create')
    </a>
@endcan
