<?php
require_once __DIR__ . '/../core/Model.php';

class Product extends Model
{
    public function getAll(int $limit = 0, int $offset = 0, ?int $categoryId = null)
    {
        $sql = 'SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id';
        $params = [];
        if ($categoryId !== null) {
            $sql .= ' WHERE p.category_id = :category_id';
            $params[':category_id'] = $categoryId;
        }
        $sql .= ' ORDER BY p.created_at DESC';
        if ($limit > 0) {
            $sql .= ' LIMIT :limit OFFSET :offset';
        }

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_INT);
        }
        if ($limit > 0) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll(?int $categoryId = null): int
    {
        if ($categoryId !== null) {
            $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM products WHERE category_id = :category_id');
            $stmt->execute([':category_id' => $categoryId]);
        } else {
            $stmt = $this->db->query('SELECT COUNT(*) as total FROM products');
        }
        $row = $stmt->fetch();
        return (int)$row['total'];
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO products (category_id, name, slug, price, stock, image, short_desc, description, specs, created_at, updated_at) VALUES (:category_id, :name, :slug, :price, :stock, :image, :short_desc, :description, :specs, NOW(), NOW())');
        $stmt->execute([
            ':category_id' => $data['category_id'],
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':price' => $data['price'],
            ':stock' => $data['stock'],
            ':image' => $data['image'],
            ':short_desc' => $data['short_desc'],
            ':description' => $data['description'],
            ':specs' => $data['specs'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update($id, array $data): void
    {
        $stmt = $this->db->prepare('UPDATE products SET category_id = :category_id, name = :name, slug = :slug, price = :price, stock = :stock, image = :image, short_desc = :short_desc, description = :description, specs = :specs, updated_at = NOW() WHERE id = :id');
        $stmt->execute([
            ':category_id' => $data['category_id'],
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':price' => $data['price'],
            ':stock' => $data['stock'],
            ':image' => $data['image'],
            ':short_desc' => $data['short_desc'],
            ':description' => $data['description'],
            ':specs' => $data['specs'],
            ':id' => $id,
        ]);
    }

    public function delete($id): void
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function reduceStock($id, $quantity): void
    {
        $stmt = $this->db->prepare('UPDATE products SET stock = stock - :qty WHERE id = :id');
        $stmt->execute([':qty' => $quantity, ':id' => $id]);
    }
}
