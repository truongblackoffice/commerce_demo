<section class="auth-form">
    <h2>Đăng nhập</h2>
    <?php if (!empty($error)): ?>
        <div class="alert"><?php echo Helpers::e($error); ?></div>
    <?php endif; ?>
    <form method="post">
        <label>Tên đăng nhập
            <input type="text" name="username" required>
        </label>
        <label>Mật khẩu
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="btn">Đăng nhập</button>
    </form>
</section>
