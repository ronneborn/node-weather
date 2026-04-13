<?php
require_once __DIR__ . '/../bootstrap/env.php';
require_once __DIR__ . '/../bootstrap/autoload.php';
require_once __DIR__ . '/../app/Helpers/functions.php';

(new App\Services\ScanService())->runNextQueued();
echo "Scan runner completed\n";
