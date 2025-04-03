<?php

namespace Tests\Feature\VideoManagementTest\VideoTest;

use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Enums\RolesEnum;
use App\Domains\VideoManagement\Enums\VideoRatingEnum;
use App\Events\VideoManagement\Video\VideoCreated;
use App\Models\User\User;
use App\Models\VideoManagement\Category\Category;
use App\Models\VideoManagement\Genre\Genre;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VideoAdministratorCreateVideoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_video_administrator_can_create_video(): void
    {
        // Arrange
        Event::fake();
        $category = Category::factory()->create();
        $genre = Genre::factory()->create();
        $videoAdministrator = UserEntity::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson('/api/admin/videos', [
                'title' => 'Video Test',
                'description' => 'Description Test',
                'duration' => 1234,
                'release_date' => '1995-03-06',
                'rating' => VideoRatingEnum::L->name,
                'is_published' => false,
                'category_id' => $category->id,
                'genre_id' => $genre->id,
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
            'response' => [
                'title' => 'Video Test',
                'description' => 'Description Test',
                'duration' => 1234,
                'release_date' => '1995-03-06',
                'rating' => VideoRatingEnum::labelByValue('L'),
                'is_published' => false,
            ]
        ]);

        $this->assertDatabaseHas('videos', [
            'title' => 'Video Test',
            'description' => 'Description Test',
            'duration' => 1234,
            'release_date' => '1995-03-06',
            'rating' => 'L',
            'is_published' => false,
        ]);

        Event::assertDispatched(VideoCreated::class);
    }

    public function test_if_video_administrator_cannot_create_video_with_invalid_data(): void
    {
        // Arrange
        Event::fake();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson('/api/admin/videos', []);

        // Assert
        $response->assertStatus(422);
        $response->assertJson([
            'type' => 'error',
            'status' => 422,
            'message' => 'Ops',
            'show' => true,
            'errors' => [
                "title" => ["The title field is required."],
                "duration" => ["The duration field is required."],
                "release_date" => ["The release date field is required."],
                "rating" => ["The rating field is required."],
                "category_id" => ["The category id field is required."],
                "genre_id" => ["The genre id field is required."],
            ]
        ]);

        $this->assertDatabaseCount('videos', 0);

        Event::assertNotDispatched(VideoCreated::class);
    }

    public function test_if_unauthenticated_user_cannot_create_video(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $genre = Genre::factory()->create();

        // Act
        $response = $this->postJson('/api/admin/videos', [
            'title' => 'Video Test',
            'description' => 'Description Test',
            'duration' => 1234,
            'release_date' => '1995-03-06',
            'rating' => VideoRatingEnum::L->name,
            'is_published' => false,
            'category_id' => $category->id,
            'genre_id' => $genre->id,
        ]);

        // Assert
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        $this->assertDatabaseMissing('videos', [
            'title' => 'Video Test',
            'description' => 'Description Test',
            'rating' => VideoRatingEnum::L->name,
        ]);
    }

    public function test_if_other_administrator_cannot_create_video(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $genre = Genre::factory()->create();
        $subscriptionAdministrator = User::factory()->create();
        $subscriptionAdministrator->assignRole(RolesEnum::SUBSCRIPTION_ADMINISTRATOR->value);
        $token = $subscriptionAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/admin/videos', [
                'title' => 'Video Test',
                'description' => 'Description Test',
                'duration' => 1234,
                'release_date' => '1995-03-06',
                'rating' => VideoRatingEnum::L->name,
                'is_published' => false,
                'category_id' => $category->id,
                'genre_id' => $genre->id,
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
        ]);
    }
}
