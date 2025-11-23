<?php
require_once __DIR__ . '/../../core/Helpers.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Shop</title>
    <link rel="stylesheet" href="<?php echo Helpers::baseUrl('assets/css/admin.css'); ?>">
</head>
<body>
<header class="admin-header">
    <div class="container">
        <h1>Admin Panel</h1>
        <nav>
            <a href="<?php echo Helpers::baseUrl('admin/index'); ?>">Dashboard</a>
            <a href="<?php echo Helpers::baseUrl('admin/products'); ?>">Sản phẩm</a>
            <a href="<?php echo Helpers::baseUrl('admin/orders'); ?>">Đơn hàng</a>
            <a href="<?php echo Helpers::baseUrl('product/index'); ?>">Về trang chủ</a>
        </nav>
    </div>
</header>
<main class="container">
