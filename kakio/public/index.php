<?php
require_once __DIR__ . '/../bootstrap/env.php';
require_once __DIR__ . '/../bootstrap/autoload.php';
require_once __DIR__ . '/../app/Helpers/functions.php';

$app = new App\Core\App();
$app->run();
