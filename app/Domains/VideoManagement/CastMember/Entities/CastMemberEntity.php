<?php

namespace App\Domains\VideoManagement\CastMember\Entities;

use App\Models\CastMember;

/**
 * Class CastMemberEntity
 * @package App\Domains\VideoManagement\Aggregates\CastMember\Entities
 *
 * @property string $name
 * @property string $role
 * @property string $bio
 */
class CastMemberEntity extends CastMember
{
    protected $table = 'cast_members';

    protected $fillable = [
        'name',
        'role',
        'bio'
    ];
}
