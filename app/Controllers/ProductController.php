<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;
use App\Support\HttpException; // membawa informasi kesalahan beserta status HTTP.
use App\Support\JsonRequest; // membaca dan memeriksa format JSON.
use App\Support\JsonResponse; // mengirim respons JSON kepada client.
use App\Validators\ProductValidator;

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

        JsonResponse::send([
            'data' => $products,
        ]);
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

        JsonResponse::send([
            'data' => $product,
        ]);
    }

    public function apiStore(): void
    {
        try {
            $payload = JsonRequest::decode();
        } catch (HttpException $exception) {
            JsonResponse::send(
                ['message' => $exception->getMessage()],
                $exception->statusCode
            );

            return;
        }

        try {
            $data = ProductValidator::validateForCreate($payload);
        } catch (HttpException $exception) {
            JsonResponse::send(
                ['message' => $exception->getMessage()],
                $exception->statusCode
            );

            return;
        }

        // Simpan produk melalui Model.
        try {
            $productId = $this->productModel->createProduct(
                $data['category_id'],
                $data['name'],
                $data['slug'],
                $data['price'],
                $data['stock']
            );
        } catch (\PDOException $exception) {
            $mysqlErrorCode = (int) ($exception->errorInfo[1] ?? 0);

            if ($mysqlErrorCode === 1062) {
                JsonResponse::send([
                    'message' => 'Slug produk sudah digunakan'
                ], 409);

                return;
            }

            if ($mysqlErrorCode === 1452) {
                JsonResponse::send([
                    'message' => 'Kategori produk tidak ditemukan.',
                ], 422);

                return;
            }

            error_log($exception->getMessage());

            JsonResponse::send([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);

            return;
        }

        // Ambil kembali produk yang sudah dibuat.
        $product = $this->productModel->findActiveById($productId);

        JsonResponse::send(
            [
                'message' => 'Produk berhasil dibuat.',
                'data' => $product,
            ],

            201,
            '/api/products/' . $productId
        );
    }
}
