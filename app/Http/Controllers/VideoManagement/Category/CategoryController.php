<?php

namespace App\Http\Controllers\VideoManagement\Category;

use App\Domains\VideoManagement\Category\Services\CategoryService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\VideoManagement\Category\StoreCategoryRequest;


class CategoryController extends AbstractController
{
    protected $requestValidate = StoreCategoryRequest::class;
    protected $requestValidateUpdate;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
