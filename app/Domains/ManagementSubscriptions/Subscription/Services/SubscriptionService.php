<?php

namespace App\Domains\ManagementSubscriptions\Subscription\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\ManagementSubscriptions\Subscription\Repositories\SubscriptionRepository;
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
