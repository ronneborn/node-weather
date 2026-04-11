<?php

declare(strict_types=1);

require_once __DIR__ . '/Autoloader.php';

$helperFiles = glob(dirname(__DIR__) . '/helpers/*.php') ?: [];
foreach ($helperFiles as $helperFile) {
    require_once $helperFile;
}

if (is_file(dirname(__DIR__, 2) . '/.env')) {
    $lines = file(dirname(__DIR__, 2) . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines ?: [] as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
            continue;
        }

        [$name, $value] = array_map('trim', explode('=', $line, 2));
        $_ENV[$name] = $value;
    }
}
