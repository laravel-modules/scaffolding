<?php

namespace App\Http\Controllers\Accounts\Api;

use App\Models\User;
use App\Support\FirebaseToken;
use Illuminate\Auth\Events\Login;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Accounts\Api\LoginRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Accounts\Api\PasswordLessLoginRequest;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var \App\Support\FirebaseToken
     */
    private $firebaseToken;

    /**
     * LoginController constructor.
     *
     * @param \App\Support\FirebaseToken $firebaseToken
     */
    public function __construct(FirebaseToken $firebaseToken)
    {
        $this->firebaseToken = $firebaseToken;
    }

    /**
     * Handle a login request to the application.
     *
     * @param \App\Http\Requests\Accounts\Api\LoginRequest $request
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

    /**
     * Handle a login request to the application using firebase.
     *
     * @param \App\Http\Requests\Accounts\Api\PasswordLessLoginRequest $request
     * @throws \Illuminate\Auth\AuthenticationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function firebase(PasswordLessLoginRequest $request)
    {
        $phone = $this->firebaseToken->getPhoneNumber($request->access_token);

        $user = User::firstOrCreate([
            'phone' => $phone,
        ], [
            'name' => 'Anonymous User',
            'phone' => $phone,
        ]);

        event(new Login('sanctum', $user, false));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice($request->device_name),
        ]);
    }
}
