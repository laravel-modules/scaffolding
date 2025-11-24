<?php

namespace Database\Factories;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'phone' => fake()->phoneNumber,
            'email' => fake()->companyEmail,
            'message' => fake()->sentence,
            'read_at' => fake()->randomElement([null, now()]),
        ];
    }
}
