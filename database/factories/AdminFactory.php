<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->unique()->phoneNumber,
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Admin $user) {
            Admin::withoutEvents(function () use ($user) {
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
