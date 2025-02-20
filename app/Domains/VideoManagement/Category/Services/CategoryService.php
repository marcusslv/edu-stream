<?php

namespace App\Domains\VideoManagement\Category\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\Category\Repositories\CategoryRepository;
use App\Events\CategoryCreated;
use App\Events\CategoryUpdated;


class CategoryService extends AbstractService
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new CategoryCreated($entity, $params));

        return $entity;
    }

    public function afterUpdate($entity, array $params): void
    {
        event(new CategoryUpdated($entity, $params));
    }
}
