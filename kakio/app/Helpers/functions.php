<?php

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        static $configs = [];
        [$file, $item] = array_pad(explode('.', $key, 2), 2, null);
        if (!isset($configs[$file])) {
            $path = __DIR__ . '/../../config/' . $file . '.php';
            $configs[$file] = file_exists($path) ? require $path : [];
        }
        return $item ? ($configs[$file][$item] ?? $default) : $configs[$file];
    }
}

if (!function_exists('app_url')) {
    function app_url(string $path = ''): string
    {
        return rtrim(config('app.url', ''), '/') . '/' . ltrim($path, '/');
    }
}
