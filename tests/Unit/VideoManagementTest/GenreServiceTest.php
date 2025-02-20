<?php

namespace Tests\Unit\VideoManagementTest;

use App\Domains\VideoManagement\Genre\Entities\GenreEntity;
use App\Domains\VideoManagement\Genre\Repositories\GenreRepository;
use App\Domains\VideoManagement\Genre\Services\GenreService;
use PHPUnit\Framework\TestCase;
use Mockery;

class GenreServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_if_create_genre_with_success(): void
    {
        // Arrange
        $repositoryMock = Mockery::mock(GenreRepository::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with(['name' => 'Name genre', 'description' => 'Description Test'])
            ->andReturn(new GenreEntity(['name' => 'Name genre', 'description' => 'Description Test']));

        $servicePartialMock = Mockery::mock(GenreService::class)->makePartial();
        $servicePartialMock->shouldReceive('getRepository')
            ->once()
            ->andReturn($repositoryMock);
        $servicePartialMock->shouldReceive('afterSave')
            ->once()
            ->andReturn(new GenreEntity(['name' => 'Name genre', 'description' => 'Description Test']));

        // Act
        $genre = $servicePartialMock->save(['name' => 'Name genre', 'description' => 'Description Test']);

        // Assert
        $this->assertInstanceOf(GenreEntity::class, $genre);
        $this->assertEquals('Name genre', $genre->name);
        $this->assertEquals('Description Test', $genre->description);
    }
}
