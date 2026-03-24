<?php

namespace App\Http\Controllers\Api;

use App\Events\VerificationCreated;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Customer;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class RegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Handle a login request to the application.
     *
     * @return JsonResource
     *
     * @throws ValidationException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function register(RegisterRequest $request)
    {
        switch ($request->type) {
            case User::CUSTOMER_TYPE:
            default:
                $user = $this->createCustomer($request);
                break;
        }

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        event(new Registered($user));

        $this->sendVerificationCode($user);

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
            'message' => trans('verification.sent'),
        ]);
    }

    /**
     * Create new customer to register to the application.
     *
     * @return Customer
     */
    public function createCustomer(RegisterRequest $request)
    {
        $customer = new Customer;

        $customer
            ->forceFill($request->only('phone', 'type'))
            ->fill($request->allWithHashedPassword())
            ->save();

        return $customer;
    }

    /**
     * Send the phone number verification code.
     *
     * @throws ValidationException
     */
    protected function sendVerificationCode(User $user): void
    {
        if (! $user || $user->phone_verified_at) {
            throw ValidationException::withMessages([
                'phone' => [trans('verification.verified')],
            ]);
        }

        $verification = Verification::updateOrCreate([
            'user_id' => $user->id,
            'phone' => $user->phone,
        ], [
            'code' => rand(1111, 9999),
        ]);

        event(new VerificationCreated($verification));
    }
}
