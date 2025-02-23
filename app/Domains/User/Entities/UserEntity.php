<?php

namespace App\Domains\User\Entities;

use App\Domains\SubscriptionManagement\Subscription\Entities\SubscriptionEntity;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserEntity
 * @package App\Domains\User\Entities
 * @property string $name
 * @property string $email
 * @property string $password
 */
class UserEntity extends User
{
    /** @use HasFactory<\Database\Factories\UserEntityFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionEntity::class);
    }
}
