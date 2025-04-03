<?php

namespace App\Http\Controllers\VideoCatalog\Catalog;

use App\Domains\VideoManagement\Video\Services\VideoService;
use App\Http\Controllers\AbstractController;

class WatchVideoController extends AbstractController
{
    public function __construct(VideoService $service)
    {
        $this->service = $service;
    }
}
