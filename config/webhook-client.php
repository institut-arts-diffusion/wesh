<?php

use App\Jobs\ProcessWebhookJob;
use App\Webhooks\DefaultSignatureValidator;

return [
    'configs' => [
//        [
//            /*
//             * This package supports multiple webhook receiving endpoints. If you only have
//             * one endpoint receiving webhooks, you can use 'default'.
//             */
//            'name' => 'default',
//
//            /*
//             * We expect that every webhook call will be signed using a secret. This secret
//             * is used to verify that the payload has not been tampered with.
//             */
//            'signing_secret' => env('WEBHOOK_CLIENT_SECRET'),
//
//            /*
//             * The name of the header containing the signature.
//             */
//            'signature_header_name' => 'Signature',
//
//            /*
//             *  This class will verify that the content of the signature header is valid.
//             *
//             * It should implement SignatureValidator
//             */
//            'signature_validator' => DefaultSignatureValidator::class,
//
//            /*
//             * This class determines if the webhook call should be stored and processed.
//             */
//            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
//
//            /*
//             * This class determines the response on a valid webhook call.
//             */
//            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
//
//            /*
//             * The classname of the model to be used to store webhook calls. The class should
//             * be equal or extend Spatie\WebhookClient\Models\WebhookCall.
//             */
//            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
//
//            /*
//             * In this array, you can pass the headers that should be stored on
//             * the webhook call model when a webhook comes in.
//             *
//             * To store all headers, set this value to `*`.
//             */
//            'store_headers' => [
//                '*'
//            ],
//
//            /*
//             * The class name of the job that will process the webhook request.
//             *
//             * This should be set to a class that extends \Spatie\WebhookClient\Jobs\ProcessWebhookJob.
//             */
//            'process_webhook_job' => ProcessWebhookJob::class,
//        ],
        [
            'name' => 'eda_prod_php_fpm',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/a96471a0-a079-416b-af26-66b6289cb8d4',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'eda_prod_caddy',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/f3b1cd2b-a31d-47b7-a114-1ce09584e5a6',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'eda_staging_php_fpm',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/08a41e42-36f4-4182-856f-b4bf28b05a59',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'eda_staging_caddy',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/a1befd79-1ed3-4c56-94dd-e649d62d9dce',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'iadpp_prod_php_fpm',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/4b679548-b972-488e-9f5f-d540f95d0d2a',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'iadpp_prod_caddy',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/5d001eb6-827a-409a-b18e-293ce0a059aa',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'iadpp_staging_php_fpm',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/1c231497-2c48-45b0-b398-26fcf909f583',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'iadpp_staging_caddy',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/8bce7579-a0db-41a0-a236-1de6392aa275',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        [
            'name' => 'wesh',
            'signing_secret' => config('app.key'),
            'signature_header_name' => 'X-Hub-Signature-256',
            'signature_validator' => DefaultSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'webhook_destination_url' => 'https://portainer.lan.iad-arts.be/api/webhooks/a0aca3ed-6235-492c-9d20-4c938a49deb4',
            'process_webhook_job' => ProcessWebhookJob::class,
        ],
        // If you want to add more configs, just copy the above and change the name and signing_secret
    ],

    /*
     * The integer amount of days after which models should be deleted.
     *
     * It deletes all records after 30 days. Set to null if no models should be deleted.
     */
    'delete_after_days' => 30,

    /*
     * Should a unique token be added to the route name
     */
    'add_unique_token_to_route_name' => false,
];
