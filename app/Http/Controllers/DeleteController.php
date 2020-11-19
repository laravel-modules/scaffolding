<?php

namespace App\Http\Controllers;

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

        flash(trans('check-all.messages.deleted', [
            'type' => $request->input('resource'),
        ]));

        return back();
    }
}
