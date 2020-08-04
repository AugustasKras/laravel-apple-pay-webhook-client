<?php


namespace App\Jobs;


use App\Services\Subscriptions;
use Spatie\WebhookClient\ProcessWebhookJob;

class ApplePayJob extends ProcessWebhookJob
{
    public function handle(Subscriptions $subscriptions): void
    {
        switch ($this->webhookCall->type) {
            case 'initial':
                $subscriptions->createSubscription($this->webhookCall->client_id, $this->webhookCall->relevant_data);
                break;
            case 'renewal_success':
                $subscriptions->renewSubscription($this->webhookCall->client_id, $this->webhookCall->relevant_data);
                break;
            case 'renewal_failure':
            case 'cancel':
                $subscriptions->expireSubscription($this->webhookCall->client_id, $this->webhookCall->relevant_data);
                break;
        }
    }

}
