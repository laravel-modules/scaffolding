<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Supervisor;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\SupervisorRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SupervisorController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * SupervisorController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Supervisor::class, 'supervisor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors = Supervisor::filter()->paginate();

        return view('dashboard.accounts.supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.supervisors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\SupervisorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupervisorRequest $request)
    {
        $supervisor = Supervisor::create($request->allWithHashedPassword());

        $supervisor->setType($request->type);

        if ($request->user()->isAdmin()) {
            $supervisor->syncPermissions($request->input('permissions', []));
        }

        $supervisor->addAllMediaFromTokens();

        flash()->success(trans('supervisors.messages.created'));

        return redirect()->route('dashboard.supervisors.show', $supervisor);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show(Supervisor $supervisor)
    {
        return view('dashboard.accounts.supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Supervisor $supervisor)
    {
        return view('dashboard.accounts.supervisors.edit', compact('supervisor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\SupervisorRequest $request
     * @param \App\Models\Supervisor $supervisor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SupervisorRequest $request, Supervisor $supervisor)
    {
        $supervisor->update($request->allWithHashedPassword());

        $supervisor->setType($request->type);

        if ($request->user()->isAdmin()) {
            $supervisor->syncPermissions($request->input('permissions', []));
        }

        $supervisor->addAllMediaFromTokens();

        flash()->success(trans('supervisors.messages.updated'));

        return redirect()->route('dashboard.supervisors.show', $supervisor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supervisor $supervisor
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Supervisor $supervisor)
    {
        $supervisor->delete();

        flash()->success(trans('supervisors.messages.deleted'));

        return redirect()->route('dashboard.supervisors.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewAnyTrash', Supervisor::class);

        $supervisors = Supervisor::onlyTrashed()->paginate();

        return view('dashboard.accounts.supervisors.trashed', compact('supervisors'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Supervisor $supervisor
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Supervisor $supervisor)
    {
        $this->authorize('viewTrash', $supervisor);

        return view('dashboard.accounts.supervisors.show', compact('supervisor'));
    }

    /**
     * Restore the trashed resource.
     *
     * @param \App\Models\Supervisor $supervisor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Supervisor $supervisor)
    {
        $this->authorize('restore', $supervisor);

        $supervisor->restore();

        flash()->success(trans('supervisors.messages.restored'));

        return redirect()->route('dashboard.supervisors.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param \App\Models\Supervisor $supervisor
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Supervisor $supervisor)
    {
        $this->authorize('forceDelete', $supervisor);

        $supervisor->forceDelete();

        flash()->success(trans('supervisors.messages.deleted'));

        return redirect()->route('dashboard.supervisors.trashed');
    }
}
