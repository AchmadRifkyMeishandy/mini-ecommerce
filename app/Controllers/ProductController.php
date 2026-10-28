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

    public function apiStore(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        // Pastikan request menggunakan JSON.
        $contentType = strtolower($_SERVER['CONTENT_TYPE'] ?? '');

        if (!str_contains($contentType, 'application/json')) {
            http_response_code(415);
            echo json_encode([
                'message' => 'content type harus application/json.'
            ]);
            return;
        }
        // Baca body request.
        $rawBody = file_get_contents('php://input');

        if ($rawBody === false || trim($rawBody) === '') {
            http_response_code(404);
            echo json_encode([
                'message' => 'Body request tidak boleh kosong.',
            ]);
            return;
        }

        // ubah JSON menjadi array PHP.
        try {
            $payload = json_decode(
                $rawBody,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $exception) {
            http_response_code(400);
            echo json_encode([
                'message' => 'format JSON tidak valid.',
            ]);
            return;
        }

        if (!is_array($payload) || array_is_list($payload)) {
            http_response_code(422);
            echo json_encode([
                'message' => 'Body harus berupa objek JSON.',
            ]);
            return;
        }

        // Baca body request.
        $rawBody = file_get_contents('php://input');

        if ($rawBody === false || trim($rawBody) === '') {
            http_response_code(400);
            echo json_encode([
                'message' => 'Body request tidak boleh kosong.',
            ]);
            return;
        }

        // ubah JSON menajadi array PHP.

        try {
            $payload = json_decode(
                $rawBody,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $exception) {
            http_response_code(400);
            echo json_encode([
                'message' => 'format JSON tidak valid.',
            ]);
            return;
        }
        // Pastikan field wajib tersedia
        if (
            !isset(
                $payload['category_id'],
                $payload['name'],
                $payload['slug'],
                $payload['price']
            )
        ) {
            http_response_code(422);
            echo json_encode([
                'message' => 'category_id, name, slug, dan price wajib diisi.'
            ]);
            return;
        }

        // Persiapkan dan validasi nilai input.
        $categoryId = filter_var(
            $payload['category_id'],
            FILTER_VALIDATE_INT
        );

        $stock = filter_var(
            $payload['stock'] ?? 0,
            FILTER_VALIDATE_INT
        );

        $name = is_string($payload['name'])
            ? trim($payload['name'])
            : '';

        $slug = is_string($payload['slug'])
            ? trim($payload['slug'])
            : '';

        $price = is_string($payload['price'])
            || is_int($payload['price'])
            || is_float($payload['price'])
            ? (string) $payload['price']
            : '';

        if (
            $categoryId === false
            || $categoryId < 1
            || $name === ''
            || mb_strlen($name, 'UTF-8') > 150
            || !preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)
            || strlen($slug) > 150
            || !preg_match('/^\d{1,10}(?:\.\d{1,2})?$/', $price)
            || $stock === false
            || $stock < 0
        ) {
            http_response_code(422);
            echo json_encode([
                'message' => 'Data produk tidak valid.',
            ]);
            return;
        }

        // Simpan produk melalui Model.
        try {
            $productId = $this->productModel->createProduct(
                $categoryId,
                $name,
                $slug,
                $price,
                $stock
            );
        } catch (\PDOException $exception) {
            $mysqlErrorCode = (int) $exception->errorInfo[1] ?? 0;

            if ($mysqlErrorCode === 1062) {
                http_response_code(409);
                echo json_encode([
                    'message' => 'Slug produk sudah digunakan'
                ]);
                return;
            }

            if ($mysqlErrorCode === 1452) {
                http_response_code(422);
                echo json_encode([
                    'message' => 'Kategori produk tidak ditemukan.',
                ]);
                return;
            }

            error_log($exception->getMessage());

            http_response_code(500);
            echo json_encode([
                'message' => 'Terjadi kesalahan pada server'
            ]);
            return;
        }

        // Ambil kembali produk yang sudah dibuat.
        $product = $this->productModel->findActiveById($productId);

        http_response_code(201);
        header('Location: /api/products/' . $productId);

        echo json_encode(
            [
                'message' => 'Produk berhasil dibuat.',
                'data' => $product,
            ],
            JSON_PRETTY_PRINT
                | JSON_UNESCAPED_UNICODE
                | JSON_THROW_ON_ERROR

        );
    }
}
