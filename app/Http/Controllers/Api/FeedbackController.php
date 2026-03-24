<?php

namespace App\Http\Controllers\Api;

use App\Events\FeedbackSent;
use App\Models\Feedback;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the feedback.
     *
     * @return JsonResponse
     *
     * @throws ValidationException
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
