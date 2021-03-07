<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Support\FirebaseToken;
use Illuminate\Auth\Events\Login;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Api\PasswordLessLoginRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
     * @param \App\Http\Requests\Api\LoginRequest $request
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
                'username' => [trans('auth.failed')],
            ]);
        }

        event(new Login('sanctum', $user, false));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }

    /**
     * Handle a login request to the application using firebase.
     *
     * @param \App\Http\Requests\Api\PasswordLessLoginRequest $request
     * @throws \Illuminate\Auth\AuthenticationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function firebase(PasswordLessLoginRequest $request)
    {
        $verifier = $this->firebaseToken->accessToken($request->access_token);

        $phone = $verifier->getPhoneNumber();

        $email = $verifier->getEmail();
        $name = $verifier->getName();

        $firebaseId = $verifier->getFirebaseId();

        $userQuery = User::where(compact('phone'))
            ->orWhere(compact('email'))
            ->orWhere('firebase_id', $firebaseId);

        if ($userQuery->exists()) {
            $user = $userQuery->first();
        } else {
            $user = User::forceCreate([
                'firebase_id' => $firebaseId,
                'name' => $name ?: 'Anonymous User',
                'email' => $email,
                'phone' => $phone,
                'phone_verified_at' => $phone ? now() : null,
                'email_verified_at' => $email ? now() : null,
            ]);
        }

        event(new Login('sanctum', $user, false));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }
}
