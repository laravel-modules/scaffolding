<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'type' => User::CUSTOMER_TYPE,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            User::withoutEvents(function () use ($user) {
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
                $user->addMedia($this->faker->randomElement($avatars))
                    ->preservingOriginal()
                    ->toMediaCollection('avatars');
            });
        });
    }
}
