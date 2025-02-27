<?php

namespace Tests\Feature\SubscriptionManagement\PlanTest;

use App\Domains\User\Enums\RolesEnum;
use App\Events\SubscriptionManagement\PlanCreated;
use App\Models\User\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SubscriptionAdministratorCreatePlanTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_subscription_administrator_cannot_create_plan_with_invalid_data(): void
    {
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR->value);
        $token = $videoAdministrator->createToken('admin_token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/plans', [
                "description" => 123,
                "features" => 2131
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'type' => 'error',
            'status' => 422,
            'message' => 'Ops',
            'show' => true,
            'errors' => [
                "name" => ["The name field is required."],
                "description" => ["The description field must be a string."],
                "price" => ["The price field is required."],
                "duration" => ["The duration field is required."],
                "features" => ["The features field must be a string."]
            ]
        ]);
    }

    public function test_if_subscription_administrator_can_create_plan(): void
    {
        Event::fake();
        $user = User::factory()->create();
        $user->assignRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR->value);
        $token = $user->createToken('admin_token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/plans', [
                "name" => 'Plan 1',
                "description" => "Description plan 1",
                "price" => 234,
                "duration" =>  1,
                "features" => "HD"
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
            'response' => [
                'id' => 1,
                'name' => 'Plan 1',
                "description" => "Description plan 1",
                "price" => 234,
                "duration" =>  1,
                "features" => "HD"
            ]
        ]);

        $this->assertDatabaseHas('plans', [
            "name" => 'Plan 1',
            "description" => "Description plan 1",
            "price" => 234,
            "duration" =>  1,
            "features" => "HD"
        ]);

        Event::assertDispatched(PlanCreated::class);
    }

    public function test_if_other_administrator_cannot_create_plan(): void
    {
        // Arrange
        $subscriptionAdministrator = User::factory()->create();
        $subscriptionAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $token = $subscriptionAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/plans', [
                "name" => 'Plan 1',
                "description" => "Description plan 1",
                "price" => 234,
                "duration" =>  1,
                "features" => "HD"
            ]);

        // Assert
        $response->assertStatus(403);
        $response->assertJson([
            'type' => 'error',
            'status' => 403,
            'message' => 'User does not have the right roles.',
            'show' => false
        ]);

        $this->assertDatabaseMissing('plans', [
            "name" => 'Plan 1',
            "description" => "Description plan 1",
            "price" => 234,
            "duration" =>  1,
            "features" => "HD"
        ]);
    }

}
