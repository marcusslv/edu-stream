<?php

namespace App\Http\Controllers\VideoManagement\Genre;

use App\Domains\VideoManagement\Genre\Services\GenreService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\VideoManagement\Genre\StoreGenreRequest;


class GenreController extends AbstractController
{
    protected $requestValidate = StoreGenreRequest::class;

    public function __construct(GenreService $service)
    {
        $this->service = $service;
    }
}
