<?php

namespace Tests\Unit;

use App\Domains\VideoManagement\Category\Entities\CategoryEntity;
use App\Domains\VideoManagement\Category\Repositories\CategoryRepository;
use App\Domains\VideoManagement\Category\Services\CategoryService;
use App\Events\CategoryCreated;
use Mockery;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_if_create_category_with_success()
    {
        $repositoryMock = Mockery::mock(CategoryRepository::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with(['name' => 'Category Test'])
            ->andReturn(new CategoryEntity(['id' => 1, 'name' => 'Category Test', 'description' => 'Description Test']));

        $servicePartialMock = Mockery::mock(CategoryService::class)->makePartial();
        $servicePartialMock->shouldReceive('getRepository')
            ->once()
            ->andReturn($repositoryMock);
        $servicePartialMock->shouldReceive('afterSave')
            ->once()
            ->andReturn(new CategoryEntity(['id' => 1, 'name' => 'Category Test', 'description' => 'Description Test']));

        $category = $servicePartialMock->save(['name' => 'Category Test']);

        $this->assertInstanceOf(CategoryEntity::class, $category);
        $this->assertEquals(1, $category->id);
        $this->assertEquals('Category Test', $category->name);
        $this->assertEquals('Description Test', $category->description);
    }
}
