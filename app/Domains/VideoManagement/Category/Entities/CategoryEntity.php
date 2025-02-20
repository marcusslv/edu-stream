<?php

namespace App\Domains\VideoManagement\Category\Entities;

use App\Domains\Catalog\Entities\CatalogEntity;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class CategoryEntity
 * @package App\Domains\VideoManagement\Aggregates\Category\Entities
 *
 * @property VideoEntity[] $videos
 * @property int $id
 * @property string $name
 * @property string $description
 */
class CategoryEntity extends Category
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(VideoEntity::class, 'category_id', 'id');
    }

    public function catalog(): MorphOne
    {
        return $this->morphOne(CatalogEntity::class, 'catalogable');
    }
}
