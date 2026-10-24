CREATE DATABASE IF NOT EXISTS mini_ecommerce
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE mini_ecommerce;

CREATE TABLE IF NOT EXISTS categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE
);

CREATE TABLE if NOT EXISTS products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    price DECIMAL(12,2) NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,

    INDEX idx_products_active_id (is_active, id),

    CONSTRAINT fk_products_category
    FOREIGN KEY (category_id)
    REFERENCES categories(id)
)