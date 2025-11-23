<article class="product-detail">
    <div class="detail-grid">
        <div>
            <img src="<?php echo Helpers::baseUrl('assets/images/' . Helpers::e($product['image'])); ?>" alt="<?php echo Helpers::e($product['name']); ?>">
        </div>
        <div>
            <h2><?php echo Helpers::e($product['name']); ?></h2>
            <p class="price"><?php echo number_format($product['price']); ?> đ</p>
            <p><?php echo nl2br(Helpers::e($product['description'])); ?></p>
            <p><strong>Tồn kho:</strong> <?php echo (int)$product['stock']; ?></p>
            <a class="btn" href="<?php echo Helpers::baseUrl('cart/add/' . $product['id']); ?>">Thêm vào giỏ hàng</a>
        </div>
    </div>
    <section class="specs">
        <h3>Thông số kỹ thuật</h3>
        <pre><?php echo Helpers::e($product['specs']); ?></pre>
    </section>
</article>
