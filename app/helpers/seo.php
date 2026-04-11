<?php

declare(strict_types=1);

if (!function_exists('seo_defaults')) {
    function seo_defaults(): array
    {
        return [
            'title' => 'Lokal Tjänstesajt',
            'description' => 'Professionella tjänster för svenska orter.',
            'canonical' => base_url(),
            'robots' => 'index,follow',
        ];
    }
}
