<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\MailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MailTemplate>
 */
class MailTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_type' => array_keys(MailTemplate::types())[0] ?? Customer::class,
            'name' => $this->faker->word,
            'subject' => $this->faker->word,
            'content' => $this->faker->sentence(),
        ];
    }
}
