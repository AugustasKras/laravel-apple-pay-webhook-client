<?php


namespace App\Interfaces;


interface SubscriptionService
{
    public function createSubscription(int $client_id, array $payment_data);

    public function renewSubscription(int $client_id, array $payment_data);

    public function expireSubscription(int $client_id, array $payment_data);
}
