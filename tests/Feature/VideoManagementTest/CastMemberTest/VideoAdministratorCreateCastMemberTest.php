<?php

namespace Tests\Feature\VideoManagementTest\CastMemberTest;

use App\Domains\User\Enums\RolesEnum;
use App\Events\CastMemberCreated;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VideoAdministratorCreateCastMemberTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_video_administrator_can_create_cast_member(): void
    {
        // Arrange
        Event::fake();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $token = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/cast-members', [
                'name' => 'Member Test',
                'role' => 'actor',
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
            'response' => [
                'id' => 1,
                "name" => "Member Test",
                "role" => [
                    'value' => 'actor',
                    'name' => 'ACTOR',
                    'label' => 'Actor',
                ]
            ]
        ]);

        $this->assertDatabaseHas('cast_members', [
            'name' => 'Member Test',
            'role' => 'actor'
        ]);

        Event::assertDispatched(CastMemberCreated::class);
    }

    public function test_if_other_administrator_cannot_create_cast_member(): void
    {
        // Arrange
        $subscriptionAdministrator = User::factory()->create();
        $subscriptionAdministrator->assignRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR->value);
        $token = $subscriptionAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/cast-members', [
                'name' => 'Member Test',
                'role' => 'actor',
            ]);

        // Assert
        $response->assertStatus(403);
        $response->assertJson([
            'type' => 'error',
            'status' => 403,
            'message' => 'User does not have the right roles.',
            'show' => false
        ]);

        $this->assertDatabaseMissing('cast_members', [
            'name' => 'Member Test',
            'role' => 'actor'
        ]);
    }

    public function test_if_unauthenticated_user_cannot_create_cast_member(): void
    {
        // Act
        $response = $this->postJson('/api/admin/cast-members', [
            'name' => 'Member Test',
            'role' => 'actor',
        ]);

        // Assert
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        $this->assertDatabaseMissing('cast_members', [
            'name' => 'Member Test',
            'role' => 'actor',
        ]);
    }

    public function test_if_video_administrator_can_create_cast_member_with_invalid_data(): void
    {
        // Arrange
        Event::fake();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson('/api/admin/cast-members', [
                'name' => '',
                'role' => '',
                'bio' => '',
            ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJson([
            'type' => 'error',
            'status' => 422,
            'message' => 'Ops',
            'show' => true,
            'errors' => [
                "name" => ["The name field is required."],
                "role" => ["The role field is required."]
            ]
        ]);

        $this->assertDatabaseCount('cast_members', 0);

        Event::assertNotDispatched(CastMemberCreated::class);
    }
}
