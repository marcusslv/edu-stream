<?php

namespace App\Domains\SubscriptionManagement\Plan\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\SubscriptionManagement\Plan\Repositories\PlanRepository;
use App\Events\PlanCreated;

class PlanService extends AbstractService
{
    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new PlanCreated($entity));

        return $entity;
    }
}
