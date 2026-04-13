<?php
namespace App\Services;

use App\Repositories\ConsentRepository;

class ConsentService
{
    public function __construct(private readonly ConsentRepository $repo = new ConsentRepository())
    {
    }

    public function store(int $websiteId, array $payload): void
    {
        $this->repo->create([
            'website_id' => $websiteId,
            'consent_uuid' => $payload['consent_uuid'],
            'revision' => (int) ($payload['revision'] ?? 1),
            'necessary' => 1,
            'statistics' => !empty($payload['consents']['statistics']) ? 1 : 0,
            'marketing' => !empty($payload['consents']['marketing']) ? 1 : 0,
            'functional' => !empty($payload['consents']['functional']) ? 1 : 0,
            'source' => substr((string) ($payload['source'] ?? 'banner'), 0, 24),
            'ip_hash' => hash('sha256', (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0')),
            'user_agent_hash' => hash('sha256', (string) ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown')),
            'page_url' => substr((string) ($payload['meta']['url'] ?? ''), 0, 512),
            'language' => substr((string) ($payload['meta']['language'] ?? 'sv'), 0, 12),
        ]);
    }
}
