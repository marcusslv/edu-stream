<?php

namespace App\Domains\VideoManagement\Category\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoManagement\Category\Entities\CategoryEntity;

class CategoryRepository extends AbstractRepository
{
    public function __construct(CategoryEntity $model)
    {
        $this->model = $model;
    }
}
