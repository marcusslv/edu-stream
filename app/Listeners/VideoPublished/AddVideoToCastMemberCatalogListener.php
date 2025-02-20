<?php

namespace App\Listeners\VideoPublished;

use App\Domains\Catalog\Services\CatalogService;
use App\Events\VideoPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddVideoToCastMemberCatalogListener
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
        $castMembers = $video->castMembers;

        foreach ($castMembers as $castMember) {
            $catalog = $this->catalogService->findOneWhere([
                'title' => $castMember->name
            ]);

            if (!$catalog) {
                continue;
            }

            $this->catalogService->addVideoCatalog($catalog, $video);
        }
    }
}
