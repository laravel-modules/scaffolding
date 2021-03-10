<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class DeleteController extends Controller
{
    /**
     * Delete the given items of the given model type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if (class_exists($modelClass = $request->input('type'))) {
            $modelClass::find($request->input('items', []))
                ->each(function ($model) {
                    if (Gate::allows('delete', $model)) {
                        $model->delete();
                    }
                });
        }

        flash()->success(trans('check-all.messages.deleted', [
            'type' => $request->input('resource'),
        ]));

        return back();
    }

    /**
     * Restore the given items of the given model type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request)
    {
        if (class_exists($modelClass = $request->input('type'))) {
            $modelClass::withTrashed()->whereIn('id', $request->input('items', []))
                ->each(function ($model) {
                    if (Gate::allows('restore', $model)) {
                        $model->restore();
                    }
                });
        }

        flash()->success(trans('check-all.messages.restored', [
            'type' => $request->input('resource'),
        ]));

        return back();
    }

    /**
     * Force delete the given items of the given model type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Request $request)
    {
        if (class_exists($modelClass = $request->input('type'))) {
            $modelClass::withTrashed()->whereIn('id', $request->input('items', []))
                ->each(function ($model) {
                    if (Gate::allows('forceDelete', $model)) {
                        $model->forceDelete();
                    }
                });
        }

        flash()->success(trans('check-all.messages.deleted', [
            'type' => $request->input('resource'),
        ]));

        return back();
    }
}
