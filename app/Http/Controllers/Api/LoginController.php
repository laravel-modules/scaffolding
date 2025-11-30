<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Authentication
 *
 * @unauthenticated
 *
 * APIs for authenticating users
 */
class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Login Users.
     *
     * @bodyParam username string required User's email or phone number. Example:333333333
     * @bodyParam password string required User's password. Example: password
     * @bodyParam type string required The type of user `customer` or `merchant`. Example:customer
     *
     * @apiResource App\Http\Resources\CustomerResource
     *
     * @apiResourceAdditional token="<<access token>>"
     *
     * @apiResourceModel App\Models\Customer
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        /** @var User $user */
        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })
            ->when($request->type, function (Builder $builder) use ($request) {
                $builder->where('type', $request->type);
            })
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);
        }

        /** @var \App\Models\User $user */
        if ($token = $request->fcm_token) {
            $user->fcmTokens()->updateOrCreate(compact('token'));
        }

        event(new Login('sanctum', $user, false));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }
}
