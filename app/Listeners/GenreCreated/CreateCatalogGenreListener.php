<?php

namespace App\Listeners\GenreCreated;

use App\Domains\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\Genre\Entities\GenreEntity;
use App\Events\GenreCreated;

class CreateCatalogGenreListener
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
    public function handle(GenreCreated $event): void
    {
        $entity = $event->entity;

        $this->catalogService->save([
            'title' => $entity->name,
            'description' => $entity->description,
            'catalogable_id' => $entity->id,
            'catalogable_type' => GenreEntity::class
        ]);
    }
}
