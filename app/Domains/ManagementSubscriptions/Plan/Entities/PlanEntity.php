<?php

namespace App\Domains\ManagementSubscriptions\Plan\Entities;

use App\Domains\ManagementSubscriptions\Subscription\Entities\SubscriptionEntity;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PlanEntity
 *
 * @package App\Domains\Subscription\Aggregates\Plan\Entities
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $duration
 * @property string $features
 * @property string $created_at
 * @property string $updated_at
 */
class PlanEntity extends Plan
{
    protected $table = 'plans';

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'features',
        'created_at',
        'updated_at',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionEntity::class, 'plan_id', 'id');
    }
}
