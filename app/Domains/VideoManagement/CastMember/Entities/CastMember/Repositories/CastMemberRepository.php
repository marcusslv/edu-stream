<?php

namespace App\Domains\VideoManagement\CastMember\Entities\CastMember\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\VideoManagement\CastMember\Entities\CastMember\Entities\CastMemberEntity;

class CastMemberRepository extends AbstractRepository
{
    public function __construct(CastMemberEntity $model)
    {
        $this->model = $model;
    }
}
