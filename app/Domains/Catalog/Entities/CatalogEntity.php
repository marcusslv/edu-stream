<?php

namespace App\Domains\Catalog\Entities;

use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Models\Catalog;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class CatalogEntity
 * @package App\Domains\Catalog\Entities
 * @property VideoEntity[] $videos
 * @property string $title
 * @property string $description
 */
class CatalogEntity extends Catalog
{
    protected $table = 'catalogs';

    protected $fillable = [
        'title',
        'description',
        'catalogable_id',
        'catalogable_type'
    ];

    protected $hidden = [
        'pivot',
        'updated_at',
        'catalogable_id',
        'catalogable_type'
    ];

    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(VideoEntity::class, 'catalog_video', 'catalog_id', 'video_id');
    }

    public function catalogable(): MorphTo
    {
        return $this->morphTo();
    }
}
