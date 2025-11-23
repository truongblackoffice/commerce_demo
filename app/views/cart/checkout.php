<section>
    <h2>Thông tin đặt hàng</h2>
    <form method="post" action="<?php echo Helpers::baseUrl('cart/placeOrder'); ?>">
        <label>Họ tên
            <input type="text" name="full_name" value="<?php echo Helpers::e($user['full_name']); ?>" required>
        </label>
        <label>Số điện thoại
            <input type="text" name="phone" value="<?php echo Helpers::e($user['phone']); ?>" required>
        </label>
        <label>Địa chỉ
            <input type="text" name="address" value="<?php echo Helpers::e($user['address']); ?>" required>
        </label>
        <h3>Đơn hàng</h3>
        <ul>
            <?php $total = 0; foreach ($cart as $item): $line = $item['price'] * $item['quantity']; $total += $line; ?>
                <li><?php echo Helpers::e($item['name']); ?> x <?php echo $item['quantity']; ?> - <?php echo number_format($line); ?> đ</li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Tổng tiền: <?php echo number_format($total); ?> đ</strong></p>
        <button type="submit" class="btn">Xác nhận đặt hàng</button>
    </form>
</section>
