<?php
namespace App\Repositories;

use App\Core\Database;

class BannerRepository
{
    public function getByWebsite(int $websiteId): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM banner_settings WHERE website_id = :website_id LIMIT 1');
        $stmt->execute(['website_id' => $websiteId]);
        return $stmt->fetch() ?: null;
    }

    public function upsert(int $websiteId, array $data): void
    {
        $current = $this->getByWebsite($websiteId);
        if ($current) {
            $stmt = Database::connection()->prepare('UPDATE banner_settings SET title=:title,body=:body,accept_text=:accept_text,deny_text=:deny_text,preferences_text=:preferences_text,position=:position,primary_color=:primary_color,updated_at=NOW(),revision=revision+1 WHERE website_id=:website_id');
            $stmt->execute($data + ['website_id' => $websiteId]);
            return;
        }

        $stmt = Database::connection()->prepare('INSERT INTO banner_settings (website_id,title,body,accept_text,deny_text,preferences_text,position,primary_color,revision,created_at,updated_at) VALUES (:website_id,:title,:body,:accept_text,:deny_text,:preferences_text,:position,:primary_color,1,NOW(),NOW())');
        $stmt->execute($data + ['website_id' => $websiteId]);
    }
}
