<section>
    <h2>Thống kê</h2>
    <ul class="stats">
        <li>Sản phẩm: <?php echo $productCount; ?></li>
        <li>Đơn hàng: <?php echo $orderCount; ?></li>
        <li>Người dùng: <?php echo $userCount; ?></li>
    </ul>
    <h3>Đơn hàng mới</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Tổng</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentOrders as $order): ?>
                <tr>
                    <td>#<?php echo $order['id']; ?></td>
                    <td><?php echo Helpers::e($order['full_name']); ?></td>
                    <td><?php echo number_format($order['total_amount']); ?> đ</td>
                    <td><?php echo Helpers::e($order['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
