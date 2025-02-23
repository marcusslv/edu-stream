<?php

namespace App\Domains\VideoManagement\Genre\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\Genre\Repositories\GenreRepository;
use App\Events\VideoManagement\Genre\GenreCreated;
use App\Events\VideoManagement\Genre\GenreUpdated;

class GenreService extends AbstractService
{
    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new GenreCreated($entity, $params));

        return $entity;
    }

    public function afterUpdate($entity, array $params): void
    {
        event(new GenreUpdated($entity, $params));
    }
}
