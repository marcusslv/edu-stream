<?php

namespace App\Domains\VideoCatalog\Catalog\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoCatalog\Catalog\Entities\CatalogEntity;
use App\Domains\VideoCatalog\Catalog\Repositories\CatalogRepository;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;

class CatalogService extends AbstractService
{
    public function __construct(CatalogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addVideoCatalog(CatalogEntity $catalog, VideoEntity $video): void
    {
        $this->repository->addVideoCatalog($catalog, $video->id);
    }
}
