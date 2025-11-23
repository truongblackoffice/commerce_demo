<section>
    <h2>Danh sách đơn hàng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Tổng</th>
                <th>Trạng thái</th>
                <th>Ngày</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?php echo $order['id']; ?></td>
                    <td><?php echo Helpers::e($order['full_name']); ?></td>
                    <td><?php echo number_format($order['total_amount']); ?> đ</td>
                    <td><?php echo Helpers::e($order['status']); ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                    <td><a href="<?php echo Helpers::baseUrl('admin/orderDetail/' . $order['id']); ?>">Xem</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
