<?php
namespace App\Repositories;

use App\Core\Database;

class WebsiteRepository
{
    public function create(array $data): int
    {
        $stmt = Database::connection()->prepare('INSERT INTO websites (user_id,domain,site_key,status,created_at,updated_at) VALUES (:user_id,:domain,:site_key,:status,NOW(),NOW())');
        $stmt->execute($data);
        return (int) Database::connection()->lastInsertId();
    }

    public function listByUser(int $userId): array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM websites WHERE user_id = :user_id ORDER BY id DESC');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function findOwned(int $id, int $userId): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM websites WHERE id = :id AND user_id = :user_id LIMIT 1');
        $stmt->execute(['id' => $id, 'user_id' => $userId]);
        return $stmt->fetch() ?: null;
    }

    public function findBySiteKey(string $siteKey): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM websites WHERE site_key = :site_key LIMIT 1');
        $stmt->execute(['site_key' => $siteKey]);
        return $stmt->fetch() ?: null;
    }
}
