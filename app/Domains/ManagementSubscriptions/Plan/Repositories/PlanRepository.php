<?php

namespace App\Domains\ManagementSubscriptions\Plan\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\ManagementSubscriptions\Plan\Entities\PlanEntity;

class PlanRepository extends AbstractRepository
{
    public function __construct(PlanEntity $model)
    {
        $this->model = $model;
    }
}
