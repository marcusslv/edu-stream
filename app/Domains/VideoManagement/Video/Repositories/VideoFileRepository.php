<?php

namespace App\Domains\VideoManagement\Video\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoManagement\Video\Entities\VideoFileEntity;

class VideoFileRepository extends AbstractRepository
{
    /**
     * @param VideoFileEntity $model
     */
    public function __construct(VideoFileEntity $model)
    {
        $this->model = $model;
    }
}
