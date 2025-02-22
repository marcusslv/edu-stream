<?php

namespace App\Domains\SubscriptionManagement\Subscription\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\SubscriptionManagement\Subscription\Repositories\SubscriptionRepository;
use App\Events\SubscriptionStarted;

class SubscriptionService extends AbstractService
{
    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, $params)
    {
        event(new SubscriptionStarted($entity, $params));

        return $entity;
    }
}
