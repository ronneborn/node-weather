<?php
namespace App\Services;

class DomainService
{
    public function normalize(string $domain): string
    {
        $domain = mb_strtolower(trim($domain));
        $domain = preg_replace('#^https?://#', '', $domain);
        return rtrim((string) $domain, '/');
    }
}
