<?php

declare(strict_types=1);

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('excerpt')) {
    function excerpt(string $text, int $limit = 140): string
    {
        $clean = trim(strip_tags($text));
        if (mb_strlen($clean) <= $limit) {
            return $clean;
        }

        return rtrim(mb_substr($clean, 0, $limit), " .,;:-") . '…';
    }
}
