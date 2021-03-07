<?php

namespace App\Http\Controllers\Api;

use App\Models\Verification;
use Illuminate\Http\Request;
use App\Events\VerificationCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;

class VerificationController extends Controller
{
    use ValidatesRequests;

    /**
     * Send or resend the verification code.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', 'unique:users,phone,'.auth()->id()],
            'password' => 'required',
        ], [], trans('verification.attributes'));

        $user = auth()->user();

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => [trans('auth.password')],
            ]);
        }

        $verification = Verification::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'phone' => $request->phone,
            'code' => rand(111111, 999999),
        ]);

        event(new VerificationCreated($verification));

        return response()->json([
            'message' => trans('verification.sent'),
        ]);
    }

    /**
     * Verify the user's phone number.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function verify(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ], [], trans('verification.attributes'));

        $verification = Verification::where([
            'user_id' => auth()->id(),
            'code' => $request->code,
        ])->first();

        if (! $verification || $verification->isExpired()) {
            throw ValidationException::withMessages([
                'code' => [trans('verification.invalid')],
            ]);
        }

        $verification->user->forceFill([
            'phone' => $verification->phone,
            'phone_verified_at' => now(),
        ])->save();

        $verification->delete();

        return $verification->user->getResource();
    }
}
