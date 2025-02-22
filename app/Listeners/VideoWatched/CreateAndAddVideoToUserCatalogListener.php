<?php

namespace App\Listeners\VideoWatched;

use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Events\VideoWatched;

class CreateAndAddVideoToUserCatalogListener
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
    public function handle(VideoWatched $event): void
    {
        $video = $event->videoEntity;
        $user = $event->userEntity;

        $catalog = $this->catalogService->findOneWhere([
            'user_id' => $user->id
        ]);

        if (!$catalog) {
            $catalog = $this->catalogService->save([
                'title' => $user->name . ' Catalog',
                'user_id' => $user->id
            ]);
        }

        $this->catalogService->addVideoCatalog($catalog, $video);
    }
}
