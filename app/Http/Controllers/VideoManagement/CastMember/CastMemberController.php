<?php

namespace App\Http\Controllers\VideoManagement\CastMember;

use App\Domains\VideoManagement\CastMember\Services\CastMemberService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\VideoManagement\CastMember\StoreCastMemberRequest;


class CastMemberController extends AbstractController
{
    public $requestValidate = StoreCastMemberRequest::class;

    public function __construct(CastMemberService $service)
    {
        $this->service = $service;
    }
}
