<?php

namespace App\Http\Controllers\CastMember;

use App\Domains\VideoManagement\CastMember\Services\CastMemberService;
use App\Http\Controllers\AbstractController;


class CastMemberController extends AbstractController
{
    public function __construct(CastMemberService $service)
    {
        $this->service = $service;
    }
}
