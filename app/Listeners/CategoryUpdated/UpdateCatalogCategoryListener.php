<?php

namespace App\Listeners\CategoryUpdated;

use App\Domains\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\Category\Entities\CategoryEntity;
use App\Events\CategoryUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
