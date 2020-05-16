<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Auth\Events\Login;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Modules\Accounts\Entities\ResetPasswordCode;
use Modules\Accounts\Entities\ResetPasswordToken;
use Modules\Accounts\Http\Requests\Api\LoginRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Accounts\Http\Requests\Api\ResetPasswordRequest;
use Modules\Accounts\Http\Requests\Api\ForgetPasswordRequest;
use Modules\Accounts\Notifications\PasswordUpdatedNotification;
use Modules\Accounts\Http\Requests\Api\PasswordLessLoginRequest;
use Modules\Accounts\Http\Requests\Api\ResetPasswordCodeRequest;
use Modules\Accounts\Notifications\SendForgetPasswordCodeNotification;

class ResetPasswordController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Send the forget password code to the user.
     *
     * @param \Modules\Accounts\Http\Requests\Api\ForgetPasswordRequest $request
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
     * @param \Modules\Accounts\Http\Requests\Api\ResetPasswordCodeRequest $request
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
        /** @var \Modules\Accounts\Entities\ResetPasswordToken $resetPasswordToken */
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

        /** @var \Modules\Accounts\Entities\User $user */
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
