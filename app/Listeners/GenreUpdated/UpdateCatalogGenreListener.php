<?php

namespace App\Listeners\GenreUpdated;

use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\Genre\Entities\GenreEntity;
use App\Events\GenreUpdated;

class UpdateCatalogGenreListener
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
    public function handle(GenreUpdated $event): void
    {
        $entity = $event->entity;

        $catalog = $this->catalogService->findOneWhere([
            'catalogable_id' => $entity->id,
            'catalogable_type' => GenreEntity::class,
        ]);

        if (is_null($catalog)) {
            logger()->error('Catalog not found', [
                'catalogable_id' => $entity->id,
                'catalogable_type' => GenreEntity::class,
            ]);

            return;
        }

        $this->catalogService->update($catalog->id, [
            'title' => data_get($event->params, 'name', $entity->name),
            'description' => data_get($event->params, 'description', $entity->description),
        ]);
    }
}
