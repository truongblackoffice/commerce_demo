CREATE DATABASE IF NOT EXISTS banhang_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE banhang_mvc;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    parent_id INT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    price DECIMAL(12,2) NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT 'placeholder.jpg',
    short_desc VARCHAR(255),
    description TEXT,
    specs TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    total_amount DECIMAL(12,2) NOT NULL,
    status ENUM('pending','processing','completed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(12,2) NOT NULL,
    total_price DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO users (username, password_hash, email, full_name, phone, address, role)
VALUES
('admin', '$2y$12$2hT0uq4l4Az9rkn5b1FZUe5WtXnm4vqisNt.HNIGNr3znrE0aQI8u', 'admin@example.com', 'Quản trị viên', '0123456789', '123 Admin Street', 'admin'),
('khach', '$2y$12$2hT0uq4l4Az9rkn5b1FZUe5WtXnm4vqisNt.HNIGNr3znrE0aQI8u', 'user@example.com', 'Khách Hàng', '0987654321', '456 User Avenue', 'user');

INSERT INTO categories (name, slug, description) VALUES
('Điện thoại', 'dien-thoai', 'Smartphone mới nhất'),
('Laptop', 'laptop', 'Laptop văn phòng'),
('Phụ kiện', 'phu-kien', 'Phụ kiện chính hãng');

INSERT INTO products (category_id, name, slug, price, stock, image, short_desc, description, specs) VALUES
(1, 'iPhone 14 Pro', 'iphone-14-pro', 29990000, 10, 'iphone.jpg', 'Flagship Apple', 'Điện thoại cao cấp với chip A16.', 'Màn 6.1\"; Chip A16; RAM 6GB; Pin 3200mAh'),
(2, 'MacBook Air M2', 'macbook-air-m2', 27990000, 5, 'macbook.jpg', 'Laptop mỏng nhẹ', 'Hiệu năng mạnh mẽ với chip M2.', 'M2; RAM 8GB; SSD 256GB; 13.6\"'),
(3, 'Tai nghe AirPods Pro', 'airpods-pro', 5490000, 20, 'airpods.jpg', 'Chống ồn chủ động', 'Âm thanh sống động.', 'Bluetooth 5.0; Chống ồn; Sạc nhanh');
