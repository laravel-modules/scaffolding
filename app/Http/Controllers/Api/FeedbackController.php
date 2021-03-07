<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Events\FeedbackSent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeedbackController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the feedback.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ], [], trans('feedback.attributes'));

        $feedback = Feedback::create($request->all());

        event(new FeedbackSent($feedback));

        return response()->json([
            'message' => trans('feedback.messages.sent'),
        ]);
    }
}
