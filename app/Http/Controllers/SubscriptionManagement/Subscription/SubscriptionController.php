<?php

namespace App\Http\Controllers\SubscriptionManagement\Subscription;

use App\Domains\SubscriptionManagement\Subscription\Services\SubscriptionService;
use App\Http\Controllers\AbstractController;


class SubscriptionController extends AbstractController
{
    public function __construct(SubscriptionService $service)
    {
        $this->service = $service;
    }
}
