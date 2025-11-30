<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Feedback;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FeedbackController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * FeedbackController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Feedback::class, 'feedback');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::filter()->latest()->paginate();

        return view('dashboard.feedback.index', compact('feedback'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        $feedback->markAsRead();

        return view('dashboard.feedback.show', compact('feedback'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        flash()->success(trans('feedback.messages.deleted'));

        return redirect()->route('dashboard.feedback.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewAnyTrash', Feedback::class);

        $feedback = Feedback::onlyTrashed()->latest('deleted_at')->paginate();

        return view('dashboard.feedback.trashed', compact('feedback'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Feedback $feedback)
    {
        $this->authorize('viewTrash', $feedback);

        return view('dashboard.feedback.show', compact('feedback'));
    }

    /**
     * Restore the trashed resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Feedback $feedback)
    {
        $this->authorize('restore', $feedback);

        $feedback->restore();

        flash()->success(trans('feedback.messages.restored'));

        return redirect()->route('dashboard.feedback.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function forceDelete(Feedback $feedback)
    {
        $this->authorize('forceDelete', $feedback);

        $feedback->forceDelete();

        flash()->success(trans('feedback.messages.deleted'));

        return redirect()->route('dashboard.feedback.trashed');
    }

    /**
     * Mark the selected messages as read.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read(Request $request)
    {
        Feedback::query()
            ->whereIn('id', $request->input('items', []))
            ->update(['read_at' => now()]);

        return redirect()->route('dashboard.feedback.index');
    }

    /**
     * Mark the selected messages as unread.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unread(Request $request)
    {
        Feedback::query()
            ->whereIn('id', $request->input('items', []))
            ->update(['read_at' => null]);

        return redirect()->route('dashboard.feedback.index');
    }
}
