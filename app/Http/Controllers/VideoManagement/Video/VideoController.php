<?php

namespace App\Http\Controllers\VideoManagement\Video;


use App\Domains\VideoManagement\Video\Services\VideoService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\VideoManagement\Video\StoreVideoRequest;
use App\Http\Requests\VideoManagement\Video\UpdateVideoRequest;


class VideoController extends AbstractController
{
    public function __construct(VideoService $service)
    {
        $this->requestValidate = StoreVideoRequest::class;
        $this->requestValidateUpdate = UpdateVideoRequest::class;
        $this->service = $service;
    }
}
