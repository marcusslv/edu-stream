<?php

namespace App\Domains\VideoManagement\Video\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\Video\Repositories\VideoFileRepository;

class VideoFileService extends AbstractService
{
    public function __construct(VideoFileRepository $repository)
    {
        $this->repository = $repository;
    }
}
