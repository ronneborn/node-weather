<?php

declare(strict_types=1);

if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        if (!isset($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
    }
}

if (!function_exists('csrf_verify')) {
    function csrf_verify(?string $token): bool
    {
        return isset($_SESSION['_csrf_token']) && is_string($token) && hash_equals($_SESSION['_csrf_token'], $token);
    }
}
