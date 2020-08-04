<?php

use App\Jobs\ApplePayJob;
use App\Models\ApplePayCall;
use App\Validators\ApplePaySignatureValidator;
use Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile;
use Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo;

return [
    'configs' => [
        [
            'name' => 'ApplePay',
            'signing_secret' => env('APPLE_PAY_SECRET'),
            'signature_header_name' => 'Signature',
            'signature_validator' => ApplePaySignatureValidator::class,
            'webhook_profile' => ProcessEverythingWebhookProfile::class,
            'webhook_response' => DefaultRespondsTo::class,
            'webhook_model' => ApplePayCall::class,
            'process_webhook_job' => ApplePayJob::class,
        ],
    ],
];
