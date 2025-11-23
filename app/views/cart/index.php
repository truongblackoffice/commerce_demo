<section>
    <h2>Giỏ hàng</h2>
    <?php if (empty($cart)): ?>
        <p>Giỏ hàng trống.</p>
    <?php else: ?>
        <form method="post" action="<?php echo Helpers::baseUrl('cart/update'); ?>">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0; foreach ($cart as $item): $line = $item['price'] * $item['quantity']; $total += $line; ?>
                    <tr>
                        <td><?php echo Helpers::e($item['name']); ?></td>
                        <td><?php echo number_format($item['price']); ?> đ</td>
                        <td><input type="number" name="quantities[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1"></td>
                        <td><?php echo number_format($line); ?> đ</td>
                        <td><a href="<?php echo Helpers::baseUrl('cart/remove/' . $item['id']); ?>">Xóa</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Tổng cộng: <?php echo number_format($total); ?> đ</strong></p>
            <button type="submit" class="btn">Cập nhật giỏ</button>
            <a class="btn" href="<?php echo Helpers::baseUrl('cart/checkout'); ?>">Đặt hàng</a>
        </form>
    <?php endif; ?>
</section>
