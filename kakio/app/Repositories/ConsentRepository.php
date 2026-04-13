<?php
namespace App\Repositories;

use App\Core\Database;

class ConsentRepository
{
    public function create(array $data): void
    {
        $stmt = Database::connection()->prepare('INSERT INTO consent_logs (website_id,consent_uuid,revision,necessary,statistics,marketing,functional,source,ip_hash,user_agent_hash,page_url,language,created_at) VALUES (:website_id,:consent_uuid,:revision,:necessary,:statistics,:marketing,:functional,:source,:ip_hash,:user_agent_hash,:page_url,:language,NOW())');
        $stmt->execute($data);
    }

    public function latestByWebsite(int $websiteId, int $limit = 50): array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM consent_logs WHERE website_id=:website_id ORDER BY id DESC LIMIT ' . (int) $limit);
        $stmt->execute(['website_id' => $websiteId]);
        return $stmt->fetchAll();
    }
}
