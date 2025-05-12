<?php

declare(strict_types=1);

// Create a route to handle the webhook based on the config name
foreach (config('webhook-client.configs') as $config) {
    $configName = $config['name'] ?? null;

    if ($configName) {
        Route::webhooks($configName.'/{signature?}', $configName);
    }
}
