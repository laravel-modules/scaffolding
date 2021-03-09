@if($customer)
    @if(method_exists($customer, 'trashed') && $customer->trashed())
        <a href="{{ route('dashboard.customers.trashed.show', $customer) }}" class="text-decoration-none text-ellipsis">
            {{ $customer->name }}
        </a>
    @else
        <a href="{{ route('dashboard.customers.show', $customer) }}" class="text-decoration-none text-ellipsis">
            {{ $customer->name }}
        </a>
    @endif
@else
    ---
@endif