<?php


namespace App\Models;


use Illuminate\Http\Request;
use Spatie\WebhookClient\Models\WebhookCall;
use Spatie\WebhookClient\WebhookConfig;

class ApplePayCall extends WebhookCall
{
    // TODO: remove, use PaymentProvider model to store PSPs
    const PROVIDER_NAME = 'ApplePay';

    const TYPE_MAP = [
        'INITIAL_BUY' => 'initial',
        'DID_RECOVER' => 'renewal_success',
        'DID_FAIL_TO_RENEW' => 'renewal_failure',
        'CANCEL' => 'cancel',
    ];

    protected $casts = [
        'relevant_data' => 'array',
        'payload' => 'array',
        'exception' => 'array',
    ];

    /**
     * @param WebhookConfig $config
     * @param Request $request
     * @return WebhookCall
     */
    public static function storeWebhook(WebhookConfig $config, Request $request): WebhookCall
    {
        return WebhookCall::create(self::parseWebhook($request));
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function parseWebhook(Request $request): array
    {
        return [
            'type' => self::TYPE_MAP[$request->input('notification_type')],
            // TODO: use Product model to bind to specific product
            'product_id' => $request->input('responseBody.latest_receipt_info.product_id'),
            'provider' => self::PROVIDER_NAME,
            'client_id' => $request->input('responseBody.client_id'),
            'relevant_data' => self::parseRelevantInfo($request->input('responseBody.latest_receipt_info')),
            'payload' => json_encode($request->input('responseBody')),
        ];
    }

    public static function parseRelevantInfo($receipt_info)
    {
        return json_encode($receipt_info);
    }

}
