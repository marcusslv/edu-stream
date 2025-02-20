<?php

namespace App\Http\Controllers\CastMember;

use App\Domains\VideoManagement\CastMember\Services\CastMemberService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\CastMember\StoreCastMemberRequest;


class CastMemberController extends AbstractController
{
    public $requestValidate = StoreCastMemberRequest::class;

    public function __construct(CastMemberService $service)
    {
        $this->service = $service;
    }
}
