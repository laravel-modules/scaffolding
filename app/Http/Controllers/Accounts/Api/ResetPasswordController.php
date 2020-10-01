<?php

namespace App\Http\Controllers\Accounts\Api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ResetPasswordCode;
use Illuminate\Auth\Events\Login;
use App\Models\ResetPasswordToken;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\Accounts\Api\ResetPasswordRequest;
use App\Http\Requests\Accounts\Api\ForgetPasswordRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\Accounts\PasswordUpdatedNotification;
use App\Http\Requests\Accounts\Api\ResetPasswordCodeRequest;
use App\Notifications\Accounts\SendForgetPasswordCodeNotification;

class ResetPasswordController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Send the forget password code to the user.
     *
     * @param \App\Http\Requests\Accounts\Api\ForgetPasswordRequest $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function forget(ForgetPasswordRequest $request)
    {
        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'username' => [trans('accounts::auth.failed')],
            ]);
        }

        $resetPasswordCode = ResetPasswordCode::updateOrCreate([
            'username' => $request->username,
        ], [
            'username' => $request->username,
            'code' => Str::random(6),
        ]);

        $user->notify(new SendForgetPasswordCodeNotification($resetPasswordCode->code));

        return response()->json([
            'message' => trans('accounts::auth.messages.forget-password-code-sent'),
            'links' => [
                'code' => [
                    'href' => route('api.password.code'),
                    'method' => 'POST',
                ],
            ],
        ]);
    }

    /**
     * Get the reset password token using verification code.
     *
     * @param \App\Http\Requests\Accounts\Api\ResetPasswordCodeRequest $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function code(ResetPasswordCodeRequest $request)
    {
        $resetPasswordCode = ResetPasswordCode::where('username', $request->username)
            ->where('code', $request->code)
            ->first();

        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        if (! $resetPasswordCode || $resetPasswordCode->isExpired() || ! $user) {
            throw ValidationException::withMessages([
                'code' => [
                    trans('validation.exists', [
                        'attribute' => trans('accounts::auth.attributes.code'),
                    ]),
                ],
            ]);
        }

        $resetPasswordCode->delete();

        ResetPasswordToken::forceCreate([
            'user_id' => $user->id,
            'token' => $token = Str::random(80),
        ]);

        return response()->json([
            'reset_token' => $token,
            'links' => [
                'reset' => [
                    'href' => route('api.password.reset'),
                    'method' => 'POST',
                ],
            ],
        ]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $resetPasswordToken = ResetPasswordToken::where($request->only('token'))->first();

        if (! $resetPasswordToken || $resetPasswordToken->isExpired()) {
            throw ValidationException::withMessages([
                'token' => [
                    trans('validation.exists', [
                        'attribute' => trans('accounts::auth.attributes.token'),
                    ]),
                ],
            ]);
        }

        $user = $resetPasswordToken->user;

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $user->notify(new PasswordUpdatedNotification());

        event(new Login('sanctum', $user, false));

        $resetPasswordToken->delete();

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice($request->device_name),
        ]);
    }
}
