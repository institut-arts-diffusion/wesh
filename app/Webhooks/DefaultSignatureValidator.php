<?php

declare(strict_types=1);

namespace App\Webhooks;

use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class DefaultSignatureValidator implements SignatureValidator
{
    /**
     * @throws InvalidConfig
     */
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->route('signature');

        if (! $signature) {
            return false;
        }

        $signingSecret = $config->signingSecret;

        if (empty($signingSecret)) {
            throw InvalidConfig::signingSecretNotSet();
        }

        return $signature === hash_hmac('sha256', '', $signingSecret);
    }
}
