<?php

namespace App\Http\Controllers\Catalog;

use App\Domains\VideoCatalog\Catalog\Services\CatalogService;
use App\Http\Controllers\AbstractController;


class CatalogController extends AbstractController
{
    public function __construct(CatalogService $service)
    {
        $this->service = $service;
    }
}
