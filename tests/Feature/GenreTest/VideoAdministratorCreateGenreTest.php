<?php

namespace Tests\Feature\GenreTest;

use App\Domains\Enums\RolesEnum;
use App\Events\GenreCreated;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VideoAdministratorCreateGenreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_video_administrator_can_create_genre(): void
    {
        // Arrange
        Event::fake();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson('/api/admin/genres', [
                'name' => 'Genre Test',
                'description' => 'Description Test',
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
            'response' => [
                "name" => "Genre Test",
                "description" => "Description Test"
            ]
        ]);

        $this->assertDatabaseHas('genres', [
            'name' => 'Genre Test',
            'description' => 'Description Test'
        ]);

        Event::assertDispatched(GenreCreated::class);
    }

    public function test_if_video_administrator_can_create_genre_with_invalid_data(): void
    {
        // Arrange
        Event::fake();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson('/api/admin/genres', [
                'name' => '',
                'description' => '',
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
            ]
        ]);

        $this->assertDatabaseCount('genres', 0);

        Event::assertNotDispatched(GenreCreated::class);
    }

    public function test_if_unauthenticated_user_cannot_create_genre(): void
    {
        // Act
        $response = $this->postJson('/api/admin/genres', [
            'name' => 'Genre Test',
            'description' => 'Description Test',
        ]);

        // Assert
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        $this->assertDatabaseMissing('genres', [
            'name' => 'Genre Test',
            'description' => 'Description Test'
        ]);
    }

    public function test_if_other_administrator_cannot_create_genre(): void
    {
        // Arrange
        $subscriptionAdministrator = User::factory()->create();
        $subscriptionAdministrator->assignRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR->value);
        $token = $subscriptionAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/genres', [
                'name' => 'Genre Test',
                'description' => 'Description Test',
            ]);

        // Assert
        $response->assertStatus(403);
        $response->assertJson([
            'type' => 'error',
            'status' => 403,
            'message' => 'User does not have the right roles.',
            'show' => false
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Genre Test',
            'description' => 'Description Test'
        ]);
    }
}
