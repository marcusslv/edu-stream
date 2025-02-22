<?php

namespace App\Domains\VideoCatalog\Catalog\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoCatalog\Catalog\Entities\CatalogEntity;

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
