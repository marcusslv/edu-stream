<?php

namespace App\Http\Controllers\VideoManagement\Video;


use App\Domains\VideoManagement\Video\Services\VideoService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Video\StoreVideoRequest;


class VideoController extends AbstractController
{
    public function __construct(VideoService $service)
    {
        $this->requestValidate = StoreVideoRequest::class;
        $this->service = $service;
    }
}
