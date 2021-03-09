@if(method_exists($customer, 'trashed') && $customer->trashed())
    @can('view', $customer)
        <a href="{{ route('dashboard.customers.trashed.show', $customer) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@else
    @can('view', $customer)
        <a href="{{ route('dashboard.customers.show', $customer) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    @endcan
@endif