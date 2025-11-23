<?php
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/OrderItem.php';
require_once __DIR__ . '/Product.php';

class Order extends Model
{
    public function createOrder(int $userId, array $customerData, array $cart): int
    {
        try {
            $this->db->beginTransaction();
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $stmt = $this->db->prepare('INSERT INTO orders (user_id, full_name, phone, address, total_amount, status, created_at, updated_at) VALUES (:user_id, :full_name, :phone, :address, :total_amount, :status, NOW(), NOW())');
            $stmt->execute([
                ':user_id' => $userId,
                ':full_name' => $customerData['full_name'],
                ':phone' => $customerData['phone'],
                ':address' => $customerData['address'],
                ':total_amount' => $total,
                ':status' => 'pending',
            ]);
            $orderId = (int)$this->db->lastInsertId();

            $orderItemModel = new OrderItem();
            $productModel = new Product();
            foreach ($cart as $item) {
                $orderItemModel->addItem($orderId, $item['id'], $item['quantity'], $item['price']);
                $productModel->reduceStock($item['id'], $item['quantity']);
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getByUser(int $userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM orders ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function getRecent(int $limit)
    {
        $stmt = $this->db->prepare('SELECT * FROM orders ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status): void
    {
        $stmt = $this->db->prepare('UPDATE orders SET status = :status, updated_at = NOW() WHERE id = :id');
        $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) as total FROM orders');
        $row = $stmt->fetch();
        return (int)$row['total'];
    }
}
