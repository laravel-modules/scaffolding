<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\Feedback\FeedbackRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        $feedback = Feedback::filter()->paginate();

        return view('dashboard.feedback.index', compact('feedback'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Feedback $feedback
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
     * @param \App\Models\Feedback $feedback
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
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

        $feedback = Feedback::onlyTrashed()->paginate();

        return view('dashboard.feedback.trashed', compact('feedback'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Feedback $feedback
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
     * @param \App\Models\Feedback $feedback
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
     * @param \App\Models\Feedback $feedback
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
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
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
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
