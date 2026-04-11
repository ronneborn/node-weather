<?php

declare(strict_types=1);

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $config = require dirname(__DIR__) . '/config/app.php';
        return rtrim($config['url'], '/') . '/' . ltrim($path, '/');
    }
}
