<?php

namespace App\Domains\SubscriptionManagement\Subscription\Entities;

use App\Domains\SubscriptionManagement\Plan\Entities\PlanEntity;
use App\Domains\User\Entities\UserEntity;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SubscriptionEntity
 * @package App\Domains\ManagementSubscriptions\Subscription\Entities
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property string $status
 * @property array $payment_details
 * @property string $started_at
 * @property string $ended_at
 * @property string $created_at
 * @property string $updated_at
 */
class SubscriptionEntity extends Subscription
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'payment_details',
        'started_at',
        'ended_at',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'user_id', 'id');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(PlanEntity::class, 'plan_id', 'id');
    }
}
