<?php
require_once __DIR__ . '/../core/Model.php';

class OrderItem extends Model
{
    public function addItem(int $orderId, int $productId, int $quantity, float $unitPrice): void
    {
        $stmt = $this->db->prepare('INSERT INTO order_items (order_id, product_id, quantity, unit_price, total_price) VALUES (:order_id, :product_id, :quantity, :unit_price, :total_price)');
        $stmt->execute([
            ':order_id' => $orderId,
            ':product_id' => $productId,
            ':quantity' => $quantity,
            ':unit_price' => $unitPrice,
            ':total_price' => $quantity * $unitPrice,
        ]);
    }

    public function getByOrder(int $orderId)
    {
        $stmt = $this->db->prepare('SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = :order_id');
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll();
    }
}
