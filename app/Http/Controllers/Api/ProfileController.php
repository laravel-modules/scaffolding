<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ProfileRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

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
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->allWithHashedPassword());

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        return $user->refresh()->getResource();
    }
}
