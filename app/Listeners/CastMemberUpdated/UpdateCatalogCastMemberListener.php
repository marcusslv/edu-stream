<?php

namespace App\Listeners\CastMemberUpdated;


use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Events\CastMemberUpdated;

class UpdateCatalogCastMemberListener
{
    public function __construct(
        public CatalogService $catalogService
    )
    {
    }

    public function handle(CastMemberUpdated $event): void
    {
        $entity = $event->entity;
        $catalog = $this->catalogService->findOneWhere([
            'catalogable_id' => $entity->id,
            'catalogable_type' => $entity::class,
        ]);

        if (is_null($catalog)) {
            logger()->error('Catalog not found', [
                'catalogable_id' => $entity->id,
                'catalogable_type' => $entity::class,
            ]);

            return;
        }

        $this->catalogService->update($catalog->id, [
            'title' => data_get($event->params, 'name', $entity->name),
            'description' => data_get($event->params, 'bio', $entity->bio),
        ]);
    }
}
