<?php

namespace App\Policies;

use App\Domains\ManagementSubscriptions\Subscription\Entities\SubscriptionEntity;
use App\Domains\User\Entities\UserEntity;

class UserPolicy
{
    public function accessContent(UserEntity $user): bool
    {
        return $user->subscriptions()
            ->where('status', 'active')
            ->exists();
    }

    public function createSubscription(UserEntity $user): bool
    {
        return !$user->subscriptions()
            ->where('status', 'active')
            ->exists();
    }

    public function cancelSubscription(UserEntity $user, SubscriptionEntity $subscription): bool
    {
        return $user->id === $subscription->user_id
            && $subscription->status === 'active';
    }

    public function changePlan(UserEntity $user, SubscriptionEntity $subscription): bool
    {
        return $user->id === $subscription->user_id
            && $subscription->status === 'active';
    }
}
