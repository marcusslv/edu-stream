<?php

namespace App\Http\Controllers\SubscriptionManagement\Subscription;

use App\Domains\SubscriptionManagement\Subscription\Services\SubscriptionService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\SubscriptionManagement\Subscription\StoreSubscriptionRequest;


class SubscriptionController extends AbstractController
{
    public function __construct(SubscriptionService $service)
    {
        $this->service = $service;
        $this->requestValidate = StoreSubscriptionRequest::class;
    }
}
