<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Verification;
use App\Events\VerificationCreated;
use Illuminate\Support\Facades\Event;

class PhoneVerificationTest extends TestCase
{
    /** @test */
    public function it_can_send_or_resend_the_phone_verification_code()
    {
        $this->actingAsCustomer();

        Event::fake();

        Customer::factory(['phone' => '123456789'])->create();


        $this->postJson(route('api.verification.send'), [
            'phone' => '123456',
            'password' => 'password',
        ])->assertSuccessful();

        Event::assertDispatched(VerificationCreated::class);
    }

    /** @test */
    public function it_can_verify_the_phone_number()
    {
        $customer = $this->actingAsCustomer();

        Event::fake();

        Verification::create([
            'user_id' => $customer->id,
            'phone' => '12345678',
            'code' => 'foobar',
        ]);

        $this->assertEquals(Verification::count(), 1);

        $this->postJson(route('api.verification.verify'), [
            'code' => 'foo',
        ])->assertJsonValidationErrors(['code']);

        $this->travelTo(now()->addMinutes(5));

        $this->postJson(route('api.verification.verify'), [
            'code' => 'foobar',
        ])->assertJsonValidationErrors(['code']);

        $this->travelBack();

        $this->postJson(route('api.verification.verify'), [
            'code' => 'foobar',
        ])->assertSuccessful();

        $this->assertEquals(Verification::count(), 0);

        $this->assertNotNull($customer->refresh()->phone_verified_at);
        $this->assertEquals($customer->phone, '12345678');
    }
}
