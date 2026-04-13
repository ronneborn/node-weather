<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\WebsiteController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$router->get('/', [HomeController::class, 'index']);
$router->get('/funktioner', [HomeController::class, 'features']);
$router->get('/priser', [HomeController::class, 'pricing']);
$router->get('/kontakt', [HomeController::class, 'contact']);

$router->get('/logga-in', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
$router->post('/logga-in', [AuthController::class, 'login'], [GuestMiddleware::class]);
$router->get('/registrera', [AuthController::class, 'showRegister'], [GuestMiddleware::class]);
$router->post('/registrera', [AuthController::class, 'register'], [GuestMiddleware::class]);
$router->get('/logga-ut', [AuthController::class, 'logout'], [AuthMiddleware::class]);
$router->get('/glomt-losenord', [AuthController::class, 'showLogin']);
$router->get('/aterstall-losenord', [AuthController::class, 'showLogin']);

$router->get('/app', [DashboardController::class, 'index'], [AuthMiddleware::class]);
$router->get('/app/konto', [DashboardController::class, 'index'], [AuthMiddleware::class]);
$router->get('/app/fakturering', [DashboardController::class, 'index'], [AuthMiddleware::class]);

$router->get('/app/webbplatser', [WebsiteController::class, 'index'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/skapa', [WebsiteController::class, 'create'], [AuthMiddleware::class]);
$router->post('/app/webbplatser/skapa', [WebsiteController::class, 'store'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/installationskod', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/banner', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->post('/app/webbplatser/{id}/banner', [WebsiteController::class, 'saveBanner'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/cookies', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/scripts', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/scans', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->post('/app/webbplatser/{id}/scans', [WebsiteController::class, 'queueScan'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/consents', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/policy', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
$router->get('/app/webbplatser/{id}/redigera', [WebsiteController::class, 'show'], [AuthMiddleware::class]);
