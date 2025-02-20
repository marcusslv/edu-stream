<?php

namespace App\Listeners\CastMemberCreated;

use App\Domains\Catalog\Services\CatalogService;
use App\Domains\VideoManagement\CastMember\Entities\CastMemberEntity;
use App\Events\CastMemberCreated;

class CreateCatalogCastMemberListener
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
    public function handle(CastMemberCreated $event): void
    {
        $entity = $event->entity;

        $this->catalogService->save([
            'title' => $entity->name,
            'description' => $entity->bio,
            'catalogable_id' => $entity->id,
            'catalogable_type' => CastMemberEntity::class,
        ]);
    }
}
