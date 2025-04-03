<?php

namespace App\Domains\VideoManagement\CastMember\Entities;

use App\Casts\VideoManagement\CastMember\CastMemberRoleCast;
use App\Domains\Abstracts\AbstractEntity;
use Database\Factories\VideoManagement\CastMember\Entities\CastMemberEntityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CastMemberEntity
 * @package App\Domains\VideoManagement\CastMember\Entities
 *
 * @property int $id
 * @property string $name
 * @property string $role
 * @property string $bio
 */
class CastMemberEntity extends AbstractEntity
{
    protected $table = 'cast_members';

    protected $fillable = [
        'name',
        'role',
        'bio'
    ];

    protected $casts = [
        'role' => CastMemberRoleCast::class
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function getClassFactory(): string
    {
        return CastMemberEntityFactory::class;
    }
}
