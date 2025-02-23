<?php

namespace App\Listeners\VideoManagement\Category\CategoryCreated;

use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\Category\Entities\CategoryEntity;
use App\Events\VideoManagement\Category\CategoryCreated;

class CreateCatalogCategoryListener
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
    public function handle(CategoryCreated $event): void
    {
        $entity = $event->entity;

        $this->catalogService->save([
            'title' => $entity->name,
            'description' => $entity->description,
            'catalogable_id' => $entity->id,
            'catalogable_type' => CategoryEntity::class,
        ]);
    }
}
