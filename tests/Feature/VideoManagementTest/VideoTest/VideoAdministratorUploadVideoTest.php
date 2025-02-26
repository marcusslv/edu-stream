<?php

namespace Tests\Feature\VideoManagementTest\VideoTest;

use App\Domains\User\Enums\RolesEnum;
use App\Events\VideoManagement\Video\VideoUploadCompleted;
use App\Models\User\User;
use App\Models\VideoManagement\Video\Video;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VideoAdministratorUploadVideoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_video_administrator_cannot_upload_video_with_invalid_data(): void
    {
        // Arrange
        Event::fake();
        $video = Video::factory()->create();
        $videoAdministrator = User::factory()->create();
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson("/api/admin/videos/{$video->id}/upload", [
                'file' => 'test'
            ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJson([
            'type' => 'error',
            'status' => 422,
            "message" => "Ops",
            'errors' => [
                'file' => [
                    'The file field must be a file.',
                    'The file field must be a file of type: mp4.',
                ]
            ],
            'show' => true,
        ]);
    }

    public function test_if_video_administrator_can_upload_video(): void
    {
        // Arrange
        Event::fake();
        Storage::fake('videos');
        $video = Video::factory()->create();
        $videoAdministrator = User::factory()->create();
        $videoFile = UploadedFile::fake()->create('test-video.mp4', 5000, 'video/mp4');
        $videoAdministrator->assignRole(RolesEnum::VIDEO_ADMINISTRATOR->value);
        $videoAdministratorToken = $videoAdministrator->createToken('admin_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', "Bearer $videoAdministratorToken")
            ->postJson("/api/admin/videos/{$video->id}/upload", [
                'file' => $videoFile
            ]);

        // Assert
        $response->assertStatus(200);


        Storage::disk('videos')->assertExists('uploads/' . $videoFile->hashName());

        $this->assertDatabaseHas('video_files', [
            'video_id' => $video->id,
            'file_name' => $videoFile->hashName(),
            'file_original_name' => $videoFile->getClientOriginalName(),
            'file_size' => $videoFile->getSize(),
            'file_path' => 'uploads/' . $videoFile->hashName(),
            'file_extension' => $videoFile->getClientOriginalExtension(),
            'file_format' => $videoFile->getMimeType()
        ]);

        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'message' => 'Operação realizada com com sucesso',
            'show' => true,
            'response' => [
                "video_id" => $video->id,
                'file_name' => $videoFile->hashName(),
                'file_original_name' => $videoFile->getClientOriginalName(),
                'file_size' => $videoFile->getSize(),
                'file_path' => 'uploads/' . $videoFile->hashName(),
                'file_extension' => $videoFile->getClientOriginalExtension(),
                'file_format' => $videoFile->getMimeType()
            ]
        ]);

        Event::assertDispatched(VideoUploadCompleted::class);
    }
}
