<?php

namespace App\Http\Controllers\VideoManagement\Video;


use App\Domains\VideoManagement\Video\Services\VideoService;
use App\Http\Controllers\AbstractController;


class VideoController extends AbstractController
{
    public function __construct(VideoService $service)
    {
        $this->service = $service;
    }
}
