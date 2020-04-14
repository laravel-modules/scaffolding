<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Modules\Accounts\Http\Filters\UserFilter;
use Modules\Accounts\Http\Requests\DashboardRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Modules\Accounts\Http\Filters\UserFilter  $filter
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilter $filter)
    {
        $users = User::filter($filter)->paginate();

        return view('accounts::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Accounts\Http\Requests\DashboardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DashboardRequest $request)
    {
        $user = User::create($request->allWithHashedPassword());

        $user->setType($request->input('type'));

        flash(trans('accounts::users.messages.created'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  Modules\Accounts\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('accounts::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Modules\Accounts\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('accounts::edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Accounts\Http\Requests\DashboardRequest  $request
     * @param  \Modules\Accounts\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(DashboardRequest $request, User $user)
    {
        $user->update($request->allWithHashedPassword());

        $user->setType($request->input('type'));

        flash(trans('accounts::users.messages.updated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Modules\Accounts\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        flash(trans('accounts::users.messages.deleted'));

        return redirect()->route('dashboard.users.index');
    }
}
