<section class="auth-form">
    <h2>Đăng ký</h2>
    <?php if (!empty($error)): ?>
        <div class="alert"><?php echo Helpers::e($error); ?></div>
    <?php endif; ?>
    <form method="post">
        <label>Tên đăng nhập
            <input type="text" name="username" required>
        </label>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Họ tên
            <input type="text" name="full_name" required>
        </label>
        <label>Số điện thoại
            <input type="text" name="phone" required>
        </label>
        <label>Địa chỉ
            <input type="text" name="address" required>
        </label>
        <label>Mật khẩu
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="btn">Đăng ký</button>
    </form>
</section>
