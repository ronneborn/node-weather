<?php

use App\Controllers\Api\BannerApiController;
use App\Controllers\Api\ConsentApiController;
use App\Controllers\Api\ScanApiController;

$router->get('/api/banner/{siteKey}', [BannerApiController::class, 'show']);
$router->post('/api/consent/{siteKey}', [ConsentApiController::class, 'store']);
$router->get('/api/scan/{siteKey}/result', [ScanApiController::class, 'result']);
$router->get('/api/health', [ScanApiController::class, 'health']);
