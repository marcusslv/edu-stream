<?php

namespace Tests\Unit\VideoManagementTest;

use App\Domains\VideoManagement\CastMember\Entities\CastMember\Entities\CastMemberEntity;
use App\Domains\VideoManagement\CastMember\Entities\CastMember\Repositories\CastMemberRepository;
use App\Domains\VideoManagement\CastMember\Entities\CastMember\Services\CastMemberService;
use App\Domains\VideoManagement\Enums\CastMemberRoleEnum;
use Mockery;
use PHPUnit\Framework\TestCase;

class CastMemberTest extends TestCase
{
    public function test_if_create_cast_member_with_success(): void
    {
        // Arrange
        $repositoryMock = Mockery::mock(CastMemberRepository::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with([
                'name' => 'Name Test',
                'role' => CastMemberRoleEnum::ACTOR->value,
                'bio' => 'Bio Test',
            ])
            ->andReturn(new CastMemberEntity([
                'name' => 'Name Test',
                'role' => CastMemberRoleEnum::ACTOR->value,
                'bio' => 'Bio Test',
            ]));

        $servicePartialMock = Mockery::mock(CastMemberService::class)->makePartial();
        $servicePartialMock->shouldReceive('getRepository')
            ->once()
            ->andReturn($repositoryMock);
        $servicePartialMock->shouldReceive('afterSave')
            ->once()
            ->andReturn(new CastMemberEntity([
                'id' => 1,
                'name' => 'Name Test',
                'role' => CastMemberRoleEnum::ACTOR->value,
                'bio' => 'Bio Test',
            ]));

        // Act
        $castMember = $servicePartialMock->save([
            'name' => 'Name Test',
            'role' => CastMemberRoleEnum::ACTOR->value,
            'bio' => 'Bio Test',
        ]);

        // Assert
        $this->assertInstanceOf(CastMemberEntity::class, $castMember);
        $this->assertEquals(CastMemberRoleEnum::ACTOR->value, data_get($castMember, 'role.value'));
        $this->assertEquals('Name Test', $castMember->name);
        $this->assertEquals('Bio Test', $castMember->bio);
    }
}
