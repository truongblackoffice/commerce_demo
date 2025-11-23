<section class="product-list">
    <h2>Danh sách sản phẩm<?php echo isset($currentCategory) && $currentCategory ? ' - ' . Helpers::e($currentCategory['name']) : ''; ?></h2>
    <div class="categories">
        <strong>Danh mục:</strong>
        <a href="<?php echo Helpers::baseUrl('product/index'); ?>">Tất cả</a>
        <?php foreach ($categories as $cat): ?>
            <a href="<?php echo Helpers::baseUrl('product/index/' . Helpers::e($cat['slug'])); ?>"><?php echo Helpers::e($cat['name']); ?></a>
        <?php endforeach; ?>
    </div>
    <div class="grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?php echo Helpers::baseUrl('assets/images/' . Helpers::e($product['image'])); ?>" alt="<?php echo Helpers::e($product['name']); ?>">
                <h3><?php echo Helpers::e($product['name']); ?></h3>
                <p class="price"><?php echo number_format($product['price']); ?> đ</p>
                <p><?php echo Helpers::e($product['short_desc']); ?></p>
                <a class="btn" href="<?php echo Helpers::baseUrl('product/detail/' . $product['id']); ?>">Xem chi tiết</a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="<?php echo $i === $page ? 'active' : ''; ?>" href="<?php echo Helpers::baseUrl('product/index' . ($currentCategory ? '/' . $currentCategory['slug'] : '') . '?page=' . $i); ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</section>
