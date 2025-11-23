<section>
    <h2>Đơn hàng #<?php echo $order['id']; ?></h2>
    <p><strong>Khách:</strong> <?php echo Helpers::e($order['full_name']); ?> - <?php echo Helpers::e($order['phone']); ?></p>
    <p><strong>Địa chỉ:</strong> <?php echo Helpers::e($order['address']); ?></p>
    <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount']); ?> đ</p>
    <form method="post" action="<?php echo Helpers::baseUrl('admin/updateOrderStatus/' . $order['id']); ?>">
        <label>Trạng thái
            <select name="status">
                <?php foreach (['pending', 'processing', 'completed', 'cancelled'] as $status): ?>
                    <option value="<?php echo $status; ?>" <?php echo $order['status'] === $status ? 'selected' : ''; ?>><?php echo ucfirst($status); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="submit" class="btn">Cập nhật</button>
    </form>

    <h3>Sản phẩm</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo Helpers::e($item['name']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['unit_price']); ?> đ</td>
                    <td><?php echo number_format($item['total_price']); ?> đ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
