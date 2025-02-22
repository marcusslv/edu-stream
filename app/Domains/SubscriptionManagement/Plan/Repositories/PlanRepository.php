<?php

namespace App\Domains\SubscriptionManagement\Plan\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\SubscriptionManagement\Plan\Entities\PlanEntity;

class PlanRepository extends AbstractRepository
{
    public function __construct(PlanEntity $model)
    {
        $this->model = $model;
    }
}
