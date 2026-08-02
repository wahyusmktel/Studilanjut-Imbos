<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Cek mode maintenance
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// 2. Load Composer Autoloader (INI WAJIB ADA SEBELUM BOOTSTRAP)
require __DIR__ . '/../vendor/autoload.php';

// 3. Bootstrap Laravel dan simpan ke variabel $app
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Set public path
$app->bind('path.public', function () {
    return __DIR__;
});

// 5. Handle request
$app->handleRequest(Request::capture());
