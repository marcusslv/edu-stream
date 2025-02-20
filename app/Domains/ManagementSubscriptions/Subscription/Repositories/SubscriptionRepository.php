<?php

namespace App\Domains\ManagementSubscriptions\Subscription\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\ManagementSubscriptions\Subscription\Entities\SubscriptionEntity;

class SubscriptionRepository extends AbstractRepository
{
    public function __construct(SubscriptionEntity $model)
    {
        $this->model = $model;
    }
}
