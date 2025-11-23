<?php
require_once __DIR__ . '/../../core/Helpers.php';
require_once __DIR__ . '/../../core/Auth.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Shop Điện Tử</title>
    <link rel="stylesheet" href="<?php echo Helpers::baseUrl('assets/css/style.css'); ?>">
</head>
<body>
<header class="site-header">
    <div class="container">
        <h1><a href="<?php echo Helpers::baseUrl('product/index'); ?>">Bán Hàng Điện Tử</a></h1>
        <nav>
            <a href="<?php echo Helpers::baseUrl('product/index'); ?>">Sản phẩm</a>
            <a href="<?php echo Helpers::baseUrl('cart/index'); ?>">Giỏ hàng</a>
            <?php if (Auth::check()): ?>
                <a href="<?php echo Helpers::baseUrl('user/profile'); ?>">Chào, <?php echo Helpers::e(Auth::user()['full_name']); ?></a>
                <a href="<?php echo Helpers::baseUrl('user/logout'); ?>">Đăng xuất</a>
                <?php if (Auth::checkAdmin()): ?>
                    <a href="<?php echo Helpers::baseUrl('admin/index'); ?>">Admin</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="<?php echo Helpers::baseUrl('user/login'); ?>">Đăng nhập</a>
                <a href="<?php echo Helpers::baseUrl('user/register'); ?>">Đăng ký</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
