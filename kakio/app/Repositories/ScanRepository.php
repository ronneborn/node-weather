<?php
namespace App\Repositories;

use App\Core\Database;

class ScanRepository
{
    public function queue(int $websiteId): void
    {
        $stmt = Database::connection()->prepare('INSERT INTO scans (website_id,status,created_at,updated_at) VALUES (:website_id,\'queued\',NOW(),NOW())');
        $stmt->execute(['website_id' => $websiteId]);
    }

    public function byWebsite(int $websiteId): array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM scans WHERE website_id=:website_id ORDER BY id DESC');
        $stmt->execute(['website_id' => $websiteId]);
        return $stmt->fetchAll();
    }
}
