<?php

namespace App\Http\Controllers\Accounts\Api;

use App\Events\VerificationCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerificationController extends Controller
{
    use ValidatesRequests;

    public function send(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ], [], trans('verification.attributes'));

        $user = User::where('phone', $request->input('phone'))->first();

        if (! $user || $user->phone_verified_at) {
            throw ValidationException::withMessages([
                'phone' => [trans('verification.verified')],
            ]);
        }

        $verification = Verification::updateOrCreate([
            'user_id' => $user->id,
            'phone' => $request->phone,
        ], [
            'code' => rand(111111, 999999),
        ]);

        event(new VerificationCreated($verification));

        return response()->json([
            'message' => trans('verification.sent'),
        ]);
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'code' => 'required',
        ], [], trans('verification.attributes'));

        $verification = Verification::where([
            'phone' => $request->phone,
            'code' => $request->code,
        ])->first();

        if (! $verification || $verification->isExpired()) {
            throw ValidationException::withMessages([
                'code' => [trans('verification.invalid')],
            ]);
        }

        $verification->user->forceFill([
            'phone_verified_at' => now(),
        ])->save();

        $verification->delete();

        return $verification->user->getResource();
    }
}
