<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;

final class ProductController
{
    public function __construct(
        private Product $productModel
    ) {}

    public function index(): void
    {
        $products = $this->productModel->allActive();

        require __DIR__ . '/../Views/products/index.php';
    }

    public function apiIndex(): void
    {
        $products = $this->productModel->allActive();

        http_response_code(200);

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(
            ['data' => $products],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
    }

    public function apiShow(int $id): void
    {
        $product = $this->productModel->findActiveById($id);

        header('Content-Type: application/json; charset=utf-8');

        if ($product == null) {
            http_response_code(404);

            echo json_encode(
                ['message' => 'Produk tidak ditemukan'],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
            );

            return;
        }

        http_response_code(200);

        echo json_encode(
            ['data' => $product],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
    }
}
