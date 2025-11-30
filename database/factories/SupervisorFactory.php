<?php

namespace Database\Factories;

use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supervisor>
 */
class SupervisorFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->unique()->phoneNumber,
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Supervisor $user) {
            Supervisor::withoutEvents(function () use ($user) {
                $user->forceFill([
                    'phone_verified_at' => now(),
                ])->save();

                $avatars = [
                    public_path('images/avatar.png'),
                    public_path('images/avatar2.png'),
                    public_path('images/avatar3.png'),
                    public_path('images/avatar04.png'),
                    public_path('images/avatar5.png'),
                    public_path('images/user1-128x128.jpg'),
                    public_path('images/user2-160x160.jpg'),
                    public_path('images/user3-128x128.jpg'),
                    public_path('images/user4-128x128.jpg'),
                    public_path('images/user5-128x128.jpg'),
                    public_path('images/user6-128x128.jpg'),
                    public_path('images/user7-128x128.jpg'),
                    public_path('images/user8-128x128.jpg'),
                ];
                $user->addMedia(fake()->randomElement($avatars))
                    ->preservingOriginal()
                    ->toMediaCollection('avatars');
            });
        });
    }
}
