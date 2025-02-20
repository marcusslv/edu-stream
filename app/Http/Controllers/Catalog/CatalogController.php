<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\AbstractController;
use App\Domains\Catalog\Services\CatalogService;


class CatalogController extends AbstractController
{
    public function __construct(CatalogService $service)
    {
        $this->service = $service;
    }
}
