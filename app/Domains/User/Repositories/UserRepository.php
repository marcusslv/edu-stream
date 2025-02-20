<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Entities\UserEntity;
use App\Domains\Abstracts\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(UserEntity $model)
    {
        $this->model = $model;
    }
}
