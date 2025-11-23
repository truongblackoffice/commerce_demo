<section>
    <h2><?php echo $product ? 'Sửa sản phẩm' : 'Thêm sản phẩm'; ?></h2>
    <form method="post" action="<?php echo Helpers::baseUrl($product ? 'admin/update/' . $product['id'] : 'admin/store'); ?>">
        <label>Tên sản phẩm
            <input type="text" name="name" value="<?php echo $product ? Helpers::e($product['name']) : ''; ?>" required>
        </label>
        <label>Slug
            <input type="text" name="slug" value="<?php echo $product ? Helpers::e($product['slug']) : ''; ?>" required>
        </label>
        <label>Danh mục
            <select name="category_id" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo $product && $product['category_id'] == $cat['id'] ? 'selected' : ''; ?>><?php echo Helpers::e($cat['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Giá
            <input type="number" step="0.01" name="price" value="<?php echo $product ? $product['price'] : 0; ?>" required>
        </label>
        <label>Tồn kho
            <input type="number" name="stock" value="<?php echo $product ? $product['stock'] : 0; ?>" required>
        </label>
        <label>Ảnh (tên file trong assets/images)
            <input type="text" name="image" value="<?php echo $product ? Helpers::e($product['image']) : 'placeholder.jpg'; ?>" required>
        </label>
        <label>Mô tả ngắn
            <textarea name="short_desc" required><?php echo $product ? Helpers::e($product['short_desc']) : ''; ?></textarea>
        </label>
        <label>Mô tả chi tiết
            <textarea name="description" required><?php echo $product ? Helpers::e($product['description']) : ''; ?></textarea>
        </label>
        <label>Thông số kỹ thuật
            <textarea name="specs" required><?php echo $product ? Helpers::e($product['specs']) : ''; ?></textarea>
        </label>
        <button type="submit" class="btn">Lưu</button>
    </form>
</section>
