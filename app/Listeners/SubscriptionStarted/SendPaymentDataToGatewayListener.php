<?php

namespace App\Listeners\SubscriptionStarted;

use App\Domains\SubscriptionManagement\Subscription\Services\SubscriptionService;
use App\Events\SubscriptionStarted;

class SendPaymentDataToGatewayListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public SubscriptionService $subscriptionService
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubscriptionStarted $event): void
    {
        // TODO: Send payment data to gateway
    }
}
