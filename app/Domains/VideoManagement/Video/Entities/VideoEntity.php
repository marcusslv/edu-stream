<?php

namespace App\Domains\VideoManagement\Video\Entities;

use App\Casts\VideoRatingCast;
use App\Domains\VideoManagement\CastMember\Entities\CastMemberEntity;
use App\Domains\VideoManagement\Category\Entities\CategoryEntity;
use App\Domains\VideoManagement\Genre\Entities\GenreEntity;
use App\Models\Video;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class VideoEntity
 * @package App\Domains\VideoManagement\Entities
 * @property string $title
 * @property string $description
 * @property int $duration
 * @property string $release_date
 * @property string $rating
 * @property bool $is_published
 * @property int $category_id
 * @property int $genre_id
 * @property int $id
 *
 * @property CategoryEntity $category
 * @property GenreEntity $genre
 * @property CastMemberEntity[] $castMembers
 * @property VideoFileEntity[] $videoFiles
 */
class VideoEntity extends Video
{
    protected $table = 'videos';

    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'rating',
        'is_published',
        'category_id',
        'genre_id'
    ];

    protected $casts = [
        'rating' => VideoRatingCast::class
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryEntity::class, 'category_id', 'id');
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(GenreEntity::class, 'genre_id', 'id');
    }

    public function castMembers(): BelongsToMany
    {
        return $this->belongsToMany(CastMemberEntity::class, 'video_cast_members', 'video_id', 'cast_member_id');
    }

    public function videoFiles(): HasMany
    {
        return $this->hasMany(VideoFileEntity::class, 'video_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(VideoStatusEntity::class, 'status_id', 'id');
    }
}
