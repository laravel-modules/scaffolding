<?php

namespace App\Http\Controllers\Accounts\Api;

use App\Models\Customer;
use App\Models\Delegate;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Accounts\Api\RegisterRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Accounts\Api\DelegateRegisterRequest;

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
        $user = Customer::create($request->allWithHashedPassword());

        $user->addAllMediaFromTokens();

        event(new Registered($user));

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param \App\Http\Requests\Accounts\Api\DelegateRegisterRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function delegateRegister(DelegateRegisterRequest $request)
    {
        DB::beginTransaction();

        $delegate = Delegate::create($request->allWithHashedPassword());

        // Save the delegate meta.
        $delegate->meta()->create($request->all());

        $delegate->addAllMediaFromTokens([], 'avatars');
        $delegate->meta->addAllMediaFromTokens([], 'identifier');
        $delegate->meta->addAllMediaFromTokens([], 'vehicle_number');

        DB::commit();

        event(new Registered($delegate));

        return $delegate->getResource()->additional([
            'token' => $delegate->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }
}
