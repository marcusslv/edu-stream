<?php

namespace App\Http\Controllers\VideoManagement\Genre;

use App\Domains\VideoManagement\Genre\Services\GenreService;
use App\Http\Controllers\AbstractController;


class GenreController extends AbstractController
{
    public function __construct(GenreService $service)
    {
        $this->service = $service;
    }
}
