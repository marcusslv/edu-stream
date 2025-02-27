<?php

namespace Database\Factories;

use App\Models\SubscriptionManagement\Subscription\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SubscriptionStatusFactory extends Factory
{
    protected $model = SubscriptionStatus::class;

    public function definition(): array
    {
        return [
            'status' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
