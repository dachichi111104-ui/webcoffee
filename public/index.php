<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Composer autoload
require __DIR__.'/../vendor/autoload.php';

// Bootstrap ứng dụng
$app = require_once __DIR__.'/../bootstrap/app.php';

// Lấy HTTP kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Xử lý request
$response = $kernel->handle(
    $request = Request::capture()
);

// Gửi response ra trình duyệt
$response->send();

// Terminate kernel
$kernel->terminate($request, $response);
