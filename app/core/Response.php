<?php

declare(strict_types=1);


namespace App\Core;


class Response
{
    public function setStatusCode(int $statusCode): void
    {
        http_response_code($statusCode);
    }

    public function redirect(string $url, int $statusCode = 302): never
    {
        header("Location: {$url}", true, $statusCode);
        exit;
    }

    public function json(array $data, int $statusCode = 200): never
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}
