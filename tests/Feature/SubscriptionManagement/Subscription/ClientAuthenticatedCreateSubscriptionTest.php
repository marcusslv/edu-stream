<?php

namespace Tests\Feature\SubscriptionManagement\Subscription;

use App\Events\SubscriptionManagement\SubscriptionStarted;
use App\Models\SubscriptionManagement\Plan\Plan;
use App\Models\User\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ClientAuthenticatedCreateSubscriptionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_authenticated_client_can_create_subscription(): void
    {
        Event::fake();
        $user = User::factory()->create();
        $plan = Plan::factory()->create();
        $token = $user->createToken('admin_token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/subscriptions', [
                "user_id" => $user->id,
                "plan_id" =>  $plan->id,
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
            'response' => [
                'id' => 1,
                "user_id" => $user->id,
                "plan_id" =>  $plan->id,
            ]
        ]);

        $this->assertDatabaseHas('subscriptions', [
            "user_id" => $user->id,
            "plan_id" =>  $plan->id,
        ]);

        Event::assertDispatched(SubscriptionStarted::class);
    }
    public function test_if_authenticated_client_cannot_create_subscription_with_invalid_data(): void
    {
        Event::fake();
        $user = User::factory()->create();
        $plan = Plan::factory()->create();
        $token = $user->createToken('admin_token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/subscriptions', [
                "user_id" => 43,
                "plan_id" => 543,
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'type' => 'error',
            'status' => 422,
            'message' => 'Ops',
            'show' => true,
            'errors' => [
                "user_id" => ["The selected user id is invalid."],
                "plan_id" => ["The selected plan id is invalid."]
            ]
        ]);

        $this->assertDatabaseMissing('subscriptions', [
            "user_id" => $user->id,
            "plan_id" =>  $plan->id,
        ]);

        Event::assertNotDispatched(SubscriptionStarted::class);
    }

    public function test_if_unauthenticated_client_cannot_create_subscription(): void
    {
        // Arrange
        Event::fake();
        $user = User::factory()->create();
        $plan = Plan::factory()->create();

        // Act
        $response = $this->postJson('/api/subscriptions', [
            "user_id" => $user->id,
            "plan_id" =>  $plan->id,
        ]);

        // Assert
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        $this->assertDatabaseMissing('subscriptions', [
            "user_id" => $user->id,
            "plan_id" =>  $plan->id,
        ]);
    }
}
