<?php

namespace App\Listeners\SubscriptionManagement\SubscriptionStarted;

use App\Domains\SubscriptionManagement\Subscription\Services\SubscriptionService;
use App\Events\SubscriptionManagement\SubscriptionStarted;

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
