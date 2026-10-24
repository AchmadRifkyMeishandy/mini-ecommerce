USE mini_ecommerce;

INSERT IGNORE INTO categories (id, name, slug)
VALUES 
    (1, 'Sepatu', 'sepatu'),
    (2, 'Kaos', 'kaos');

INSERT IGNORE INTO products
    (category_id, name, slug, price, stock, is_active)
VALUES
    (1, 'Sneakers Hitam', 'sneakers-hitam', 350000, 10, 1),
    (1, 'Sepatu Lari', 'sepatu-lari', 425000, 8, 1),
    (2, 'Kaos Polos', 'kaos-polos', 85000, 25, 1);