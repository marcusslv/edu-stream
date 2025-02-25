<?php

namespace Tests\Feature\VideoManagementTest\VideoTest;

use App\Domains\User\Enums\RolesEnum;
use App\Domains\VideoManagement\Enums\VideoRatingEnum;
use App\Events\VideoManagement\Video\VideoPublished;
use App\Models\User\User;
use App\Models\VideoManagement\Video\Video;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VideoAdministratorPublishVideoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_video_administrator_can_publish_video(): void
    {
        // Arrange
        Event::fake();
        $video = Video::factory()->create();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->putJson("/api/admin/videos/{$video->id}", [
                'is_published' => true
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
        ]);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'is_published' => true,
        ]);

        Event::assertDispatched(VideoPublished::class);
    }

    public function test_if_video_administrator_can_update_video_not_dispatched_event(): void
    {
        // Arrange
        Event::fake();
        $video = Video::factory()->create([
            'title' => 'fake 123'
        ]);
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->putJson("/api/admin/videos/{$video->id}", [
                'title' => 'Teste 123',
                'is_published' => false
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
        ]);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'title' => 'Teste 123',
        ]);

        Event::assertNotDispatched(VideoPublished::class);
    }

    public function test_if_video_administrator_cannot_update_video_with_invalid_data(): void
    {
        // Arrange
        Event::fake();
        $video = Video::factory()->create([
            'title' => 'fake 123'
        ]);
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->putJson("/api/admin/videos/{$video->id}", [
                'title' => '12'
            ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJson([
            'type' => 'error',
            'status' => 422,
            'message' => 'Ops',
            'show' => true,
            'errors' => [
                "title" => ["The title field must be at least 3 characters."],
            ]
        ]);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'title' => $video->title,
        ]);

        Event::assertNotDispatched(VideoPublished::class);
    }

    public function test_if_unauthenticated_user_cannot_update_video(): void
    {
        // Arrange
        Event::fake();
        $video = Video::factory()->create([
            'title' => 'fake 123'
        ]);

        // Act
        $response = $this->putJson("/api/admin/videos/{$video->id}", [
                'title' => 'Teste 123',
                'is_published' => true
            ]);

        // Assert
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        $this->assertDatabaseMissing('videos', [
            'id' => $video->id,
            'title' => 'Teste 123',
            'is_published' => true,
        ]);

        Event::assertNotDispatched(VideoPublished::class);
    }

    public function test_if_other_administrator_cannot_update_video(): void
    {
        // Arrange
        $video = Video::factory()->create();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR);
        $token = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/videos', [
                'title' => 'Video Test',
                'description' => 'Description Test',
                'duration' => 1234,
                'release_date' => '1995-03-06',
                'rating' => VideoRatingEnum::L->name,
                'is_published' => false
            ]);

        // Assert
        $response->assertStatus(403);
        $response->assertJson([
            'type' => 'error',
            'status' => 403,
            'message' => 'User does not have the right roles.',
            'show' => false
        ]);

        $this->assertDatabaseMissing('videos', [
            'title' => 'Video Test',
            'description' => 'Description Test',
            'rating' => VideoRatingEnum::L->value,
            'is_published' => false
        ]);
    }
}
