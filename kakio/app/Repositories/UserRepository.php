<?php
namespace App\Repositories;

use App\Core\Database;

class UserRepository
{
    public function findByEmail(string $email): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => mb_strtolower($email)]);
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $stmt = Database::connection()->prepare('INSERT INTO users (name,email,password_hash,role,created_at,updated_at) VALUES (:name,:email,:password_hash,:role,NOW(),NOW())');
        $stmt->execute($data);
        return (int) Database::connection()->lastInsertId();
    }
}
