<?php

namespace App\Domains\VideoManagement\Video\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Domains\VideoManagement\Video\Entities\VideoFileEntity;
use App\Domains\VideoManagement\Video\Repositories\VideoRepository;
use App\Events\VideoCreated;
use App\Events\VideoPublished;
use App\Events\VideoUploadCompleted;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class VideoStatusService extends AbstractService
{
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }
}
