<?php

namespace App\Listeners\VideoManagement\Video\VideoUploadCompleted;

use App\Domains\VideoConversion\Services\VideoConversionService;
use App\Events\VideoManagement\Video\VideoUploadCompleted;

class VideoConverterListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public VideoConversionService $videoConversionService
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoUploadCompleted $event): void
    {
        // TODO: Send convert video
    }
}
