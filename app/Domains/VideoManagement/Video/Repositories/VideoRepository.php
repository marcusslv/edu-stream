<?php

namespace App\Domains\VideoManagement\Video\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Domains\VideoManagement\Video\Entities\VideoFileEntity;

class VideoRepository extends AbstractRepository
{
    /**
     * @param VideoEntity $model
     */
    public function __construct(VideoEntity $model)
    {
        $this->model = $model;
    }
}
