<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Accounts\Http\Requests\Api\ProfileRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display the authenticated user resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show()
    {
        return auth()->user()->getResource();
    }

    /**
     * Update the authenticated user profile.
     *
     * @param \Modules\Accounts\Http\Requests\Api\ProfileRequest $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProfileRequest $request)
    {
        /** @var \Modules\Accounts\Entities\User $user */
        $user = auth()->user();

        $user->update($request->allWithHashedPassword());

        if ($request->avatar) {
            $user->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        return $user->getResource();
    }
}
