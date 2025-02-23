<?php

namespace App\Domains\VideoManagement\Video\Entities;

use App\Models\VideoManagement\Video\VideoFiles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class VideoFileEntity
 *
 * @package App\Domains\VideoManagement\Entities
 *
 * @property int $id
 * @property int $video_id
 * @property string $file_name
 * @property string $file_original_name
 * @property string $file_path
 * @property int $file_size
 * @property string $file_format
 * @property string $file_extension
 * @property string $created_at
 * @property string $updated_at
 *
 * @property VideoEntity $video
 */
class VideoFileEntity extends VideoFiles
{
    /**
     * @var string
     */
    protected $table = 'video_files';

    /**
     * @var string[]
     */
    protected $fillable = [
        'video_id',
        'hash',
        'file_name',
        'file_path',
        'file_size',
        'file_format',
        'file_extension',
        'created_at',
        'updated_at',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(VideoEntity::class, 'video_id', 'id');
    }
}
