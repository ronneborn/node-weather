<?php
namespace App\Services;

use App\Core\Database;

class ScanService
{
    public function runNextQueued(): void
    {
        $db = Database::connection();
        $scan = $db->query("SELECT * FROM scans WHERE status='queued' ORDER BY id ASC LIMIT 1")->fetch();
        if (!$scan) {
            return;
        }

        $db->prepare("UPDATE scans SET status='running', started_at=NOW(), updated_at=NOW() WHERE id=:id")->execute(['id' => $scan['id']]);

        $website = $db->prepare('SELECT * FROM websites WHERE id=:id LIMIT 1');
        $website->execute(['id' => $scan['website_id']]);
        $site = $website->fetch();

        try {
            $html = @file_get_contents('https://' . $site['domain']);
            preg_match_all('/<script[^>]+src=["\']([^"\']+)["\']/i', $html ?: '', $matches);
            $scripts = array_unique($matches[1] ?? []);

            foreach ($scripts as $src) {
                $category = str_contains($src, 'google') || str_contains($src, 'facebook') ? 'marketing' : 'uncategorized';
                $stmt = $db->prepare('INSERT INTO scripts (website_id,scan_id,src,category,created_at) VALUES (:website_id,:scan_id,:src,:category,NOW())');
                $stmt->execute(['website_id' => $site['id'], 'scan_id' => $scan['id'], 'src' => $src, 'category' => $category]);
            }

            $db->prepare("UPDATE scans SET status='completed', completed_at=NOW(), result_summary=:summary, updated_at=NOW() WHERE id=:id")
                ->execute(['summary' => json_encode(['scripts' => count($scripts)]), 'id' => $scan['id']]);
        } catch (\Throwable $e) {
            $db->prepare("UPDATE scans SET status='failed', error_message=:error, updated_at=NOW() WHERE id=:id")
                ->execute(['error' => substr($e->getMessage(), 0, 255), 'id' => $scan['id']]);
        }
    }
}
