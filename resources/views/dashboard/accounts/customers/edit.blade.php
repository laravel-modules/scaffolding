<x-layout :title="$customer->name" :breadcrumbs="['dashboard.customers.edit', $customer]">
    {{ BsForm::resource('customers')->putModel($customer, route('dashboard.customers.update', $customer), ['files' => true]) }}
    @component('dashboard::components.box')
        @slot('title', trans('customers.actions.edit'))

        @include('dashboard.accounts.customers.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('customers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
