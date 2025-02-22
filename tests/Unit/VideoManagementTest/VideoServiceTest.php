<?php

namespace Tests\Unit\VideoManagementTest;

use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Domains\VideoManagement\Video\Repositories\VideoRepository;
use App\Domains\VideoManagement\Video\Services\VideoService;
use Mockery;
use PHPUnit\Framework\TestCase;

class VideoServiceTest extends TestCase
{
    public function test_if_create_video_with_success(): void
    {
        // Arrange
        $repositoryMock = Mockery::mock(VideoRepository::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with(['title' => 'Name genre', 'description' => 'Description Test'])
            ->andReturn(new VideoEntity([
                'title' => 'Name video',
                'description' => 'Description Test',
                'duration' => 1233,
                'release_date' => now(),
                'category_id' => 1,
                'genre_id' => 1
            ]));

        $servicePartialMock = Mockery::mock(VideoService::class)->makePartial();
        $servicePartialMock->shouldReceive('getRepository')
            ->once()
            ->andReturn($repositoryMock);
        $servicePartialMock->shouldReceive('afterSave')
            ->once()
            ->andReturn(new VideoEntity([
                'title' => 'Name video',
                'description' => 'Description Test',
                'duration' => 1233,
                'release_date' => now(),
                'category_id' => 1,
                'genre_id' => 1
            ]));

        // Act
        $video = $servicePartialMock->save(['title' => 'Name genre', 'description' => 'Description Test']);

        // Assert
        $this->assertInstanceOf(VideoEntity::class, $video);
        $this->assertEquals('Name video', $video->title);
        $this->assertEquals('Description Test', $video->description);
    }
}
