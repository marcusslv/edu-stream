<?php

namespace App\Domains\VideoManagement\Genre\Entities;

use App\Domains\VideoCatalog\Catalog\Entities\CatalogEntity;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Models\VideoManagement\Genre\Genre;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class GenreEntity
 * @package App\Domains\Video\Aggregates\Genre\Entities
 *
 * @property VideoEntity[] $videos
 * @property int $id
 * @property string $name
 * @property string $description
 */
class GenreEntity extends Genre
{
    protected $table = 'genres';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(VideoEntity::class, 'genre_id', 'id');
    }

    public function catalog(): MorphOne
    {
        return $this->morphOne(CatalogEntity::class, 'catalogable');
    }
}
