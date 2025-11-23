<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO users (username, password_hash, email, full_name, phone, address, role, created_at) VALUES (:username, :password_hash, :email, :full_name, :phone, :address, :role, NOW())');
        $stmt->execute([
            ':username' => $data['username'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':email' => $data['email'],
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':role' => $data['role'] ?? 'user',
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function findByUsername(string $username)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        return $stmt->fetch();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) as total FROM users');
        $row = $stmt->fetch();
        return (int)$row['total'];
    }
}
