<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessWebhookJob extends \Spatie\WebhookClient\Jobs\ProcessWebhookJob
{
    use Queueable;

    public function handle(): void
    {
        Log::info('ProcessWebhookJob started.', ['webhook_call_id' => $this->webhookCall->id, 'config_name' => $this->webhookCall->name]);

        $configName = $this->webhookCall->name;
        $config = $this->webhookClientConfig($configName);

        Log::info('ProcessWebhookJob started.', ['webhook_call_id' => $this->webhookCall->id, 'config_name' => $configName]);

        $destinationWebhookUrl = Arr::get($config, 'webhook_destination_url');

        if (!$destinationWebhookUrl) {
            Log::error('Destination URL missing in configuration: ', ['webhook_call_id' => $this->webhookCall->id, 'config_name' => $configName]);
            $this->fail(new \Exception('Destination URL missing for config ' . $configName));
            return;
        }

        try {
            Log::info('Calling Portainer webhook.', [
                'webhook_call_id' => $this->webhookCall->id,
                'config_name' => $configName,
                'destination_url_masked' => substr($destinationWebhookUrl, 0, strrpos($destinationWebhookUrl, '/')) . '/*****',
            ]);

            $response = Http::timeout(20)
                        ->retry(2, 500)
                        ->post($destinationWebhookUrl);

            if ($response->successful()) {
                Log::info('Webhook successfully called', [
                    'webhook_call_id' => $this->webhookCall->id,
                    'config_name' => $configName,
                    'destination_status' => $response->status(),
                ]);
            } else {
                Log::error('Failed to call webhook', [
                    'webhook_call_id' => $this->webhookCall->id,
                    'config_name' => $configName,
                    'destination_status' => $response->status(),
                    'destination_response' => $response->body(),
                ]);

                $this->fail(new \Exception('Webhook returned error: ' . $response->status()));
            }

        } catch (ConnectionException $e) {
            Log::critical('Could not connect to target webhook (ConnectionException).', [
                'webhook_call_id' => $this->webhookCall->id,
                'config_name' => $configName,
                'error' => $e->getMessage(),
            ]);
            $this->fail($e);

        } catch (Throwable $e) {
            Log::critical('Unexpected error while calling the target webhook', [
                'webhook_call_id' => $this->webhookCall->id,
                'config_name' => $configName,
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            // Faire échouer le job
            $this->fail($e);
        }
    }

    public function failed(Throwable $exception): void
    {
        $configName = Arr::get($this->webhookClientConfig($this->webhookCall->name), 'name', 'unknown');
        Log::error('ProcessWebhookJob failed.', [
            'webhook_call_id' => $this->webhookCall->id ?? null,
            'config_name' => $configName,
            'exception_message' => $exception->getMessage(),
        ]);
    }

    private function webhookClientConfig(string $configName): array
    {
        return Arr::first(
            config('webhook-client.configs', []),
            static fn ($config) => isset($config['name']) && $config['name'] === $configName
        ) ?? [];

    }
}
