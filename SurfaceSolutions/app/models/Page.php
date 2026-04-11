<?php
namespace App\Models;

class Page extends BaseModel
{
    protected string $table = 'pages';

    public function create(array $data): int
    {
        $fields = array_keys($data);
        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ',created_at,updated_at) VALUES (:' . implode(',:', $fields) . ',NOW(),NOW())';
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
        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $sets) . ',updated_at = NOW() WHERE id = :id';
        $data['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
