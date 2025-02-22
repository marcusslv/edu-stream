<?php

namespace App\Listeners\VideoPublished;

use App\Domains\VideoCatalog\Catalog\Entities\CatalogEntity;
use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Events\VideoPublished;

class AddVideoToCategoryCatalogListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public CatalogService $catalogService
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoPublished $event): void
    {
        /** @var VideoEntity $entity */
        $video = $event->entity;
        /** @var CatalogEntity $catalog **/
        $catalog = $this->catalogService->findOneWhere([
            'title' => $video->category->name
        ]);

        if (!$catalog) {
            return;
        }

        $this->catalogService->addVideoCatalog($catalog, $video);
    }
}
