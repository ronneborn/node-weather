<?php
namespace App\Services;

class SiteKeyService
{
    public function generate(): string
    {
        return 'kk_' . bin2hex(random_bytes(16));
    }
}
