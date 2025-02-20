<?php

namespace App\Listeners\VideoUploadCompleted;

use App\Domains\VideoConversion\Services\VideoConversionService;
use App\Events\VideoUploadCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
