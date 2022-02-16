<?php

namespace Database\Factories;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
            'message' => $this->faker->sentence,
            'read_at' => $this->faker->randomElement([null, now()]),
        ];
    }
}
