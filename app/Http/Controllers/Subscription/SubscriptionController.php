<?php

namespace App\Http\Controllers\Subscription;

use App\Domains\ManagementSubscriptions\Subscription\Services\SubscriptionService;
use App\Http\Controllers\AbstractController;


class SubscriptionController extends AbstractController
{
    public function __construct(SubscriptionService $service)
    {
        $this->service = $service;
    }
}
