<?php
namespace App\Services;

use App\Repositories\BannerRepository;

class BannerService
{
    public function __construct(private readonly BannerRepository $repo = new BannerRepository())
    {
    }

    public function save(int $websiteId, array $input): void
    {
        $payload = [
            'title' => trim($input['title'] ?? 'Vi använder cookies'),
            'body' => trim($input['body'] ?? 'Vi använder cookies för statistik och bättre upplevelse.'),
            'accept_text' => trim($input['accept_text'] ?? 'Acceptera alla'),
            'deny_text' => trim($input['deny_text'] ?? 'Neka alla'),
            'preferences_text' => trim($input['preferences_text'] ?? 'Anpassa val'),
            'position' => trim($input['position'] ?? 'bottom'),
            'primary_color' => trim($input['primary_color'] ?? '#1d4ed8'),
        ];

        $this->repo->upsert($websiteId, $payload);
    }
}
