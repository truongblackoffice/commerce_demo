# Bán Hàng Điện Tử - PHP MVC

Skeleton dự án PHP MVC chạy trên XAMPP/Apache, sử dụng MySQL + PDO và tuân thủ các thực hành bảo mật cơ bản.

## Cấu trúc thư mục
```
/banhang_mvc/
├── app
│   ├── core           # Router, Controller, Model, Database, Auth, Session, Helpers
│   ├── controllers    # Controller cho user/product/cart/admin
│   ├── models         # Tầng truy cập dữ liệu (PDO)
│   └── views          # View + layout
├── public             # Document root trỏ vào đây
│   ├── index.php      # Front controller
│   ├── .htaccess      # Rewrite về index.php
│   └── assets         # CSS/JS/Images
├── config
│   └── config.php     # Thông tin DB + base_url
└── sql
    └── schema.sql     # Tạo DB + dữ liệu mẫu
```

## Yêu cầu hệ thống
- PHP 7.4+ (đã bật extension pdo_mysql)
- MySQL 5.7+/MariaDB
- Apache (XAMPP) với mod_rewrite bật

## Hướng dẫn chạy trên XAMPP (Windows/Linux/macOS)
1. **Clone hoặc copy** thư mục `banhang_mvc` vào `htdocs` của XAMPP (ví dụ `C:/xampp/htdocs/banhang_mvc`).
2. Import database:
   - Mở phpMyAdmin hoặc terminal MySQL và chạy file `sql/schema.sql`:
     ```
     mysql -u root -p < sql/schema.sql
     ```
   - Database mặc định: `banhang_mvc` (được tạo trong script). Người dùng mặc định `root` không mật khẩu (tùy cấu hình XAMPP).
3. Cấu hình:
   - Mở `config/config.php` và chỉnh `base_url`, tài khoản DB theo môi trường của bạn.
4. Thiết lập VirtualHost (tùy chọn nhưng khuyến nghị):
   ```
   <VirtualHost *:80>
       ServerName banhang_mvc.local
       DocumentRoot "C:/xampp/htdocs/banhang_mvc/public"
       <Directory "C:/xampp/htdocs/banhang_mvc/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
   Sau đó thêm `127.0.0.1 banhang_mvc.local` vào file hosts.
5. Khởi động Apache + MySQL trong XAMPP, truy cập `http://banhang_mvc.local` (hoặc `http://localhost/banhang_mvc/public`).

## Tài khoản mẫu
- Admin: `admin` / `admin123`
- User: `khach` / `admin123`

## Chức năng chính
- **User**: đăng ký, đăng nhập (password_hash/verify), xem profile + lịch sử đơn hàng.
- **Product**: danh sách, xem chi tiết, lọc theo danh mục, phân trang cơ bản.
- **Cart**: thêm/xóa/cập nhật số lượng (SESSION), tính tổng, checkout (tạo orders + order_items, trừ tồn kho).
- **Admin** (role = admin): dashboard thống kê, CRUD sản phẩm, xem/cập nhật trạng thái đơn hàng.

## Lưu ý bảo mật & coding
- Tất cả truy vấn dùng PDO prepared statements.
- Mật khẩu lưu bằng `password_hash`, kiểm tra `password_verify`.
- Router front controller (`public/index.php` + `.htaccess`) xử lý URL dạng `/controller/action/param`.
- Session được bọc qua `Session` helper.

## Mở rộng
- Có thể bổ sung CSRF token, validation nâng cao, upload ảnh thật, và phân trang nâng cao tùy nhu cầu.
