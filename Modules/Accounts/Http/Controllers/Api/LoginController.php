<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Accounts\Http\Requests\Api\LoginRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Handle a login request to the application.
     *
     * @param \Modules\Accounts\Http\Requests\Api\LoginRequest $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function login(LoginRequest $request)
    {
        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => [trans('accounts::auth.failed')],
            ]);
        }

        event(new Login('sanctum', $user, false));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice($request->device_name),
        ]);
    }
}
