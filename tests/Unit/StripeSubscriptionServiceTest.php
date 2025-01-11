<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Services\StripeSubscriptionService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StripeSubscriptionServiceTest extends TestCase
{
    #[Test]
    public function testCreateTrialSubscription(): void
    {
        $team = $this->createMock(Team::class);
        $team->stripe_customer_id = 'customer_id';

        $stripeSubscriptionService = $this->getMockBuilder(StripeSubscriptionService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stripeClientMock = $this->getMockBuilder(\Stripe\StripeClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stripeClientMock->subscriptions = $this->getMockBuilder(\Stripe\Service\SubscriptionService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stripeClientMock->subscriptions->expects($this->once())
            ->method('create')
            ->with([
                'customer' => $team->stripe_customer_id,
                'items'    => [
                    ['price' => env('STRIPE_PRICE_ID')],
                ],
                'trial_period_days' => 14,
            ])
            ->willReturn((object) ['id' => 'subscription_id']);

        $stripeSubscriptionService->expects($this->once())
            ->method('createTrialSubscription')
            ->with($team)
            ->willReturnCallback(function ($team) {
                $team->subscriptions()->create([
                    'stripe_subscription_id' => 'subscription_id',
                    'trial_ends_at'          => now()->addDays(14),
                ]);
            }
});

        // Call the method under test
        $stripeSubscriptionService->createTrialSubscription($team);

        // Assert the expected behavior
        // Add assertions here
    }
}
}
