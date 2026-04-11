<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\Session;

require_once dirname(__DIR__) . '/app/core/bootstrap.php';

$appConfig = require dirname(__DIR__) . '/app/config/app.php';
$dbConfig = require dirname(__DIR__) . '/app/config/database.php';

date_default_timezone_set($appConfig['timezone']);

$session = new Session();
$session->start($appConfig['session_name']);

// Initiera anslutningen tidigt så fel fångas direkt under utveckling.
Database::connection($dbConfig);

$request = new Request();
$response = new Response();
$router = new Router();

$router->get('/', [HomeController::class, 'index']);

$router->dispatch($request, $response);
