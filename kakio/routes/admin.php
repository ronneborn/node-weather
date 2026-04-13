<?php

use App\Controllers\AdminController;
use App\Middleware\AdminMiddleware;

$router->get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/anvandare', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/anvandare/{id}', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/webbplatser', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/webbplatser/{id}', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/abonnemang', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/loggar', [AdminController::class, 'index'], [AdminMiddleware::class]);
$router->get('/admin/scans', [AdminController::class, 'index'], [AdminMiddleware::class]);
