<?php

namespace App\Domains\VideoManagement\Video\Entities;

use App\Models\VideoManagement\Video\VideoStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoStatusEntity extends VideoStatus
{
    protected $table = 'video_statuses';

    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(VideoEntity::class, 'status_id', 'id');
    }
}
