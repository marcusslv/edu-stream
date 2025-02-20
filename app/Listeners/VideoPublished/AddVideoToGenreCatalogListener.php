<?php

namespace App\Listeners\VideoPublished;

use App\Domains\Catalog\Entities\CatalogEntity;
use App\Domains\Catalog\Services\CatalogService;
use App\Events\VideoPublished;

class AddVideoToGenreCatalogListener
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
        $video = $event->entity;
        /** @var CatalogEntity $catalog **/
        $catalog = $this->catalogService->findOneWhere([
            'title' => $video->genre->name
        ]);

        if (!$catalog) {
            return;
        }

        $this->catalogService->addVideoCatalog($catalog, $video);
    }
}
