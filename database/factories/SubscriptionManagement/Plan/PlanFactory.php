<?php

namespace Database\Factories\SubscriptionManagement\Plan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionManagement\Plan\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name,
            "description" => fake()->sentence(),
            "price" => 1000,
            "duration" =>  1,
            "features" => fake()->randomElement(['HD', '4 screens'])
        ];
    }
}
