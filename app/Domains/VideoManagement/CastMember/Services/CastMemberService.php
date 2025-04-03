<?php

namespace App\Domains\VideoManagement\CastMember\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\CastMember\Repositories\CastMemberRepository;
use App\Events\VideoManagement\CastMember\CastMemberCreated;
use App\Events\VideoManagement\CastMember\CastMemberUpdated;

class CastMemberService extends AbstractService
{
    public function __construct(CastMemberRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, $params)
    {
        event(new CastMemberCreated($entity, $params));

        return $entity;
    }

    public function afterUpdate($entity, $params): void
    {
        event(new CastMemberUpdated($entity, $params));
    }
}
