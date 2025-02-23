<?php

namespace App\Domains\VideoManagement\Video\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\Video\Repositories\VideoRepository;

class VideoFileService extends AbstractService
{
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }
}
