<?php
function base_url(string $path = ''): string
{
    $app = require __DIR__ . '/../config/app.php';
    return rtrim($app['base_url'], '/') . '/' . ltrim($path, '/');
}
