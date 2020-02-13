<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);

        $admins = Admin::paginate();

        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\AdminRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->allWithHashedPassword());

        flash(trans('admins.messages.created'));

        return redirect()->route('dashboard.admins.show', $admin);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $this->authorize('view', $admin);

        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $this->authorize('update', $admin);

        return view('dashboard.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\AdminRequest$request
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->allWithHashedPassword());

        flash(trans('admins.messages.updated'));

        return redirect()->route('dashboard.admins.show', $admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('delete', $admin);

        $admin->delete();

        return redirect()->route('dashboard.admins.index');
    }
}
