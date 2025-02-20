<?php

namespace App\Http\Controllers\Subscription\Plan;

use App\Domains\ManagementSubscriptions\Plan\Services\PlanService;
use App\Http\Controllers\AbstractController;


class PlanController extends AbstractController
{
    public function __construct(PlanService $service)
    {
        $this->service = $service;
    }
}
