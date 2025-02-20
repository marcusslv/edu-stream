<?php

namespace App\Domains\VideoManagement\Genre\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoManagement\Genre\Entities\GenreEntity;

class GenreRepository extends AbstractRepository
{
    public function __construct(GenreEntity $model)
    {
        $this->model = $model;
    }
}
