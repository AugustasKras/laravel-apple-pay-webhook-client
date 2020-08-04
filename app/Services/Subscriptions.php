<?php


namespace App\Services;


use App\Interfaces\SubscriptionService;

class Subscriptions implements SubscriptionService
{

    public function createSubscription(int $client_id, $payment_data)
    {
        // TODO: Write subscription creation logic
        // Enable access, save subscription data
    }

    public function renewSubscription(int $client_id, $payment_data)
    {
        // TODO: Write subscription renewal logic
        // Enable access (if it was revoked), save subscription data
    }

    public function expireSubscription(int $client_id, $payment_data)
    {
        // TODO: Write subscription expiration logic
        // Check expiry_date in $payment_data and either set subscription to be expired or revoke access instantly
    }
}
