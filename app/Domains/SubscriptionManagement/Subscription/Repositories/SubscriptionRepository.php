<?php

namespace App\Domains\SubscriptionManagement\Subscription\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\SubscriptionManagement\Subscription\Entities\SubscriptionEntity;

class SubscriptionRepository extends AbstractRepository
{
    public function __construct(SubscriptionEntity $model)
    {
        $this->model = $model;
    }
}
