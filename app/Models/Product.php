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
}
