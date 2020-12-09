<?php

namespace App\Http\Controllers\Accounts\Api;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Accounts\Api\RegisterRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Handle a login request to the application.
     *
     * @param \App\Http\Requests\Accounts\Api\RegisterRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->allWithHashedPassword());

        $user->addAllMediaFromTokens();

        event(new Registered($user));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }
}
