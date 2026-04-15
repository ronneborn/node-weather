<?php

declare(strict_types=1);


namespace App\Core;


class Request
{
    public function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public function uri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        return '/' . trim(parse_url($uri, PHP_URL_PATH) ?? '/', '/');
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($_GET, $_POST);
    }
}
