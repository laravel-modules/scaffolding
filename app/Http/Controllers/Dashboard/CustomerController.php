<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Customer;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Customer::class, 'customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::filter()->paginate();

        return view('dashboard.accounts.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->allWithHashedPassword());

        $customer->setType($request->type);

        $customer->addAllMediaFromTokens();

        flash(trans('customers.messages.created'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('dashboard.accounts.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.accounts.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\CustomerRequest $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->allWithHashedPassword());

        $customer->setType($request->type);

        $customer->addAllMediaFromTokens();

        flash(trans('customers.messages.updated'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        flash(trans('customers.messages.deleted'));

        return redirect()->route('dashboard.customers.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewTrash', Customer::class);

        $customers = Customer::onlyTrashed()->paginate();

        return view('dashboard.accounts.customers.trashed', compact('customers'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Customer $customer)
    {
        return view('dashboard.accounts.customers.show', compact('customer'));
    }

    /**
     * Restore the trashed resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Customer $customer)
    {
        $this->authorize('restore', $customer);

        $customer->restore();

        flash()->success(trans('customers.messages.restored'));

        return redirect()->route('dashboard.customers.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Customer $customer)
    {
        $this->authorize('forceDelete', $customer);

        $customer->forceDelete();

        flash(trans('customers.messages.deleted'));

        return redirect()->route('dashboard.customers.trashed');
    }
}
