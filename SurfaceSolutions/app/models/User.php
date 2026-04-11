<?php
namespace App\Models;

class User extends BaseModel
{
    protected string $table = 'users';

    public function create(array $data): int
    {
        $fields = array_keys($data);
        $sql = 'INSERT INTO users (' . implode(',', $fields) . ',created_at,updated_at) VALUES (:' . implode(',:', $fields) . ',NOW(),NOW())';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sets = [];
        foreach (array_keys($data) as $field) {
            $sets[] = "$field = :$field";
        }
        $data['id'] = $id;
        $sql = 'UPDATE users SET ' . implode(',', $sets) . ',updated_at = NOW() WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }
}
