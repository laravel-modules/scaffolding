<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Accounts\Http\Requests\Api\LoginRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Accounts\Http\Requests\Api\RegisterRequest;

class RegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Handle a login request to the application.
     *
     * @param \Modules\Accounts\Http\Requests\Api\RegisterRequest $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function register(RegisterRequest $request)
    {
        /** @var \Modules\Accounts\Entities\User $user */
        $user = User::create($request->allWithHashedPassword());

        if ($request->avatar) {
            $user->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        event(new Registered($user));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice($request->device_name),
        ]);
    }
}
