<?php

declare(strict_types=1);

Route::webhooks('wesh', 'default');
Route::webhooks('eda_prod_php_fpm', 'eda_prod_php_fpm');
Route::webhooks('eda_prod_caddy', 'eda_prod_caddy');
Route::webhooks('eda_staging_php_fpm', 'eda_staging_php_fpm');
Route::webhooks('eda_staging_caddy', 'eda_staging_caddy');