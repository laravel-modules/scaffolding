<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CustomerRequest;
use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

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
        $customers = Customer::filter()->latest()->paginate();

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->allWithHashedPassword());

        $customer->setType($request->type);

        $customer->addAllMediaFromTokens($request->avatar);

        flash()->success(trans('customers.messages.created'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('dashboard.accounts.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.accounts.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->allWithHashedPassword());

        $customer->setType($request->type);

        $customer->addAllMediaFromTokens($request->avatar);

        flash()->success(trans('customers.messages.updated'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        flash()->success(trans('customers.messages.deleted'));

        return redirect()->route('dashboard.customers.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewAnyTrash', Customer::class);

        $customers = Customer::onlyTrashed()->latest('deleted_at')->paginate();

        return view('dashboard.accounts.customers.trashed', compact('customers'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Customer $customer)
    {
        $this->authorize('viewTrash', $customer);

        return view('dashboard.accounts.customers.show', compact('customer'));
    }

    /**
     * Restore the trashed resource.
     *
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
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function forceDelete(Customer $customer)
    {
        $this->authorize('forceDelete', $customer);

        $customer->forceDelete();

        flash()->success(trans('customers.messages.deleted'));

        return redirect()->route('dashboard.customers.trashed');
    }
}
