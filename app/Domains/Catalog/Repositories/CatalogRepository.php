<?php

namespace App\Domains\Catalog\Repositories;

use App\Domains\Catalog\Entities\CatalogEntity;
use App\Domains\Abstracts\AbstractRepository;

class CatalogRepository extends AbstractRepository
{
    public function __construct(CatalogEntity $model)
    {
        $this->model = $model;
    }

    public function addVideoCatalog(CatalogEntity $catalog, int $videoId): void
    {
        $catalog->videos()->attach($videoId);
    }
}
