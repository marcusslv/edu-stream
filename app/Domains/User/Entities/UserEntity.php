<?php

namespace App\Domains\User\Entities;

use App\Domains\SubscriptionManagement\Subscription\Entities\SubscriptionEntity;
use Database\Factories\User\UserEntityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
class UserEntity extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $table = 'users';
    protected $guard_name = 'api';

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function newFactory(): UserEntityFactory
    {
        $class = UserEntityFactory::class;

        return $class::new();
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionEntity::class);
    }
}
