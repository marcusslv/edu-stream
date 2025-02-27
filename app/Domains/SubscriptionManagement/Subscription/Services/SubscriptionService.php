<?php

namespace App\Domains\SubscriptionManagement\Subscription\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\SubscriptionManagement\Subscription\Repositories\SubscriptionRepository;
use App\Events\SubscriptionManagement\SubscriptionStarted;

class SubscriptionService extends AbstractService
{
    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeSave(array $data): array
    {
        $data['started_at'] = data_get($data, 'started_at', now()->format('Y-m-d H:i:s'));

        return $data;
    }

    public function afterSave($entity, $params)
    {
        event(new SubscriptionStarted($entity, $params));

        return $entity;
    }
}
