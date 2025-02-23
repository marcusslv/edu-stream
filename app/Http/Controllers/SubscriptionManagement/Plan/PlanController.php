<?php

namespace App\Http\Controllers\SubscriptionManagement\Plan;

use App\Domains\SubscriptionManagement\Plan\Services\PlanService;
use App\Http\Controllers\AbstractController;


class PlanController extends AbstractController
{
    public function __construct(PlanService $service)
    {
        $this->service = $service;
    }
}
