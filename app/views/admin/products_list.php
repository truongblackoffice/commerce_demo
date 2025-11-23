<section>
    <h2>Quản lý sản phẩm</h2>
    <a class="btn" href="<?php echo Helpers::baseUrl('admin/productForm'); ?>">Thêm sản phẩm</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo Helpers::e($product['name']); ?></td>
                    <td><?php echo number_format($product['price']); ?> đ</td>
                    <td><?php echo $product['stock']; ?></td>
                    <td>
                        <a href="<?php echo Helpers::baseUrl('admin/productForm/' . $product['id']); ?>">Sửa</a> |
                        <a href="<?php echo Helpers::baseUrl('admin/delete/' . $product['id']); ?>" onclick="return confirm('Xóa sản phẩm?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
