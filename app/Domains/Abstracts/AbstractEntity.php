<?php

namespace App\Domains\Abstracts;

use Database\Factories\VideoManagement\CastMember\Entities\CastMemberEntityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEntity extends Model
{
    use HasFactory;

    abstract protected static function getClassFactory();

    protected static function newFactory()
    {
        $class = static::getClassFactory();

        return $class::new();
    }
}
