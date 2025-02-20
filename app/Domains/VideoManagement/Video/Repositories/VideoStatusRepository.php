<?php

namespace App\Domains\VideoManagement\Video\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoManagement\Video\Entities\VideoStatusEntity;

class VideoStatusRepository extends AbstractRepository
{
    /**
     * @param VideoStatusEntity $model
     */
    public function __construct(VideoStatusEntity $model)
    {
        $this->model = $model;
    }
}
