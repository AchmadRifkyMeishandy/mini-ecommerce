<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Product
{
    public function __construct(
        private PDO $db
    ) {}

    public function allActive(): array
    {
        $sql = "SELECT p.id, p.name, p.price, p.stock, c.name AS category_name
        FROM products AS p
        INNER JOIN categories AS c
            ON c.id = p.category_id
        WHERE p.is_active = 1
        ORDER BY p.id DESC
        ";

        $statement = $this->db->query($sql);

        return $statement->fetchAll();
    }

    public function findActiveById(int $id): ?array
    {
        $sql = "SELECT p.id, p.name, p.price, p.stock, c.name AS category_name
        FROM products AS p
        INNER JOIN categories AS c
            ON c.id = p.category_id
        WHERE p.id =  :id
            AND p.is_active = 1
        LIMIT 1";

        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);

        $product = $statement->fetch();

        return $product === false ? null : $product;
    }

    public function createProduct(
        int $categoryId,
        string $name,
        string $slug,
        string $price,
        int $stock
    ): int {
        $sql = "INSERT INTO products (
            category_id,
            name,
            slug,
            price,
            stock
        ) VALUES (
            :category_id,
            :name,
            :slug,
            :price,
            :stock
        )";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'stock' => $stock,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function updateActiveProduct(
        int $id,
        int $categoryId,
        string $name,
        string $slug,
        string $price,
        int $stock
    ): void {
        $sql = "UPDATE products
                SET category_id = :category_id,
                    name = :name,
                    slug = :slug,
                    price = :price,
                    stock = :stock
                WHERE id = :id
                    AND is_active = 1";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            'id' => $id,
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'stock' => $stock,
        ]);
    }

    public function deactivateActiveProduct(int $id): bool
    {
        $sql = "UPDATE products
                SET is_active = 0
                WHERE id = :id
                    AND is_active = 1";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->rowCount() > 0;
    }
}
