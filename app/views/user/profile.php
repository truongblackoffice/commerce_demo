<section>
    <h2>Thông tin tài khoản</h2>
    <p><strong>Họ tên:</strong> <?php echo Helpers::e($user['full_name']); ?></p>
    <p><strong>Email:</strong> <?php echo Helpers::e($user['email']); ?></p>
    <p><strong>Điện thoại:</strong> <?php echo Helpers::e($user['phone']); ?></p>
    <p><strong>Địa chỉ:</strong> <?php echo Helpers::e($user['address']); ?></p>

    <h3>Đơn hàng của bạn</h3>
    <?php if (empty($orders)): ?>
        <p>Chưa có đơn hàng.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?php echo $order['id']; ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td><?php echo number_format($order['total_amount']); ?> đ</td>
                        <td><?php echo Helpers::e($order['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
