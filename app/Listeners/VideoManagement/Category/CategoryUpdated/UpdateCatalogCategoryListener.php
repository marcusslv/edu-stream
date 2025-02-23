<?php

namespace App\Listeners\VideoManagement\Category\CategoryUpdated;

use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\Category\Entities\CategoryEntity;
use App\Events\VideoManagement\Category\CategoryUpdated;

class UpdateCatalogCategoryListener
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
    public function handle(CategoryUpdated $event): void
    {
        $entity = $event->entity;
        $catalog = $this->catalogService->findOneWhere([
            'catalogable_id' => $entity->id,
            'catalogable_type' => CategoryEntity::class,
        ]);

        if (is_null($catalog)) {
            logger()->error('Catalog not found', [
                'catalogable_id' => $entity->id,
                'catalogable_type' => CategoryEntity::class,
            ]);

            return;
        }

        $this->catalogService->update($catalog->id, [
            'title' => data_get($event->params, 'name', $entity->name),
            'description' => data_get($event->params, 'description', $entity->description),
        ]);
    }
}
