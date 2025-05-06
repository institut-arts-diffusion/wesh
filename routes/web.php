<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
Route::prefix('webhooks')
    ->group(base_path('routes/webhooks.php'));