<?php

namespace Database\Factories\VideoManagement\CastMember\Entities;

use App\Domains\VideoManagement\CastMember\Entities\CastMemberEntity;
use App\Domains\VideoManagement\Enums\CastMemberRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CastMemberEntityFactory extends Factory
{
    protected $model = CastMemberEntity::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => CastMemberRoleEnum::ACTOR->value,
            'bio' => fake()->sentence(),
        ];
    }
}
