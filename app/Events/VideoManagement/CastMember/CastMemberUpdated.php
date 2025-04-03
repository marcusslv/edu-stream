<?php

namespace App\Events\VideoManagement\CastMember;

use App\Domains\VideoManagement\CastMember\Entities\CastMemberEntity;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CastMemberUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public CastMemberEntity $entity,
        public array $params
    )
    {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name')
        ];
    }

    public function broadcastAs(): string
    {
        return 'cast-member.updated';
    }
}
