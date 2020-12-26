<?php

namespace Tests\Feature\Accounts\Api;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Verification;
use App\Events\VerificationCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhoneVerificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_mark_phone_number_as_unverified_when_change_it()
    {
        $customer = Customer::factory()->create();

        $customer->forceFill([
            'phone_verified_at' => now(),
        ])->save();

        $this->assertNotNull($customer->phone_verified_at);

        $customer->update([
            'phone' => 123456789,
        ]);

        $this->assertNull($customer->phone_verified_at);
    }

    /** @test */
    public function it_can_send_or_resend_the_phone_verification_code()
    {
        Event::fake();

        Customer::factory(['phone' => '123456789'])->create();

        $this->postJson(route('api.verification.send'), [
            'phone' => '123',
        ])->assertJsonValidationErrors(['phone']);

        $this->postJson(route('api.verification.send'), [
            'phone' => '123456789',
        ])->assertSuccessful();

        Event::assertDispatched(VerificationCreated::class);
    }

    /** @test */
    public function it_can_verify_the_phone_number()
    {
        Event::fake();

        $customer = Customer::factory(['phone' => '123456789'])->create();

        Verification::create([
            'user_id' => $customer->id,
            'phone' => '123456789',
            'code' => 'foobar',
        ]);

        $this->assertEquals(Verification::count(), 1);

        $this->postJson(route('api.verification.verify'), [
            'phone' => '123456789',
            'code' => 'foo',
        ])->assertJsonValidationErrors(['code']);

        $this->travelTo(now()->addMinutes(5));

        $this->postJson(route('api.verification.verify'), [
            'phone' => '123456789',
            'code' => 'foobar',
        ])->assertJsonValidationErrors(['code']);

        $this->travelBack();

        $this->postJson(route('api.verification.verify'), [
            'phone' => '123456789',
            'code' => 'foobar',
        ])->assertSuccessful();

        $this->assertEquals(Verification::count(), 0);

        $this->assertNotNull($customer->refresh()->phone_verified_at);
    }
}
