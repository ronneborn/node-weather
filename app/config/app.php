<?php

declare(strict_types=1);

return [
    'app_name' => 'Lokal Tjänstesajt',
    'env' => $_ENV['APP_ENV'] ?? 'development',
    'debug' => filter_var($_ENV['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOL),
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    'timezone' => $_ENV['APP_TIMEZONE'] ?? 'Europe/Stockholm',
    'session_name' => $_ENV['SESSION_NAME'] ?? 'lokal_tjanstesajt',
];
