<?php

declare(strict_types=1);

use App\Controllers\ProductController;
use App\Models\Product;

$pdo = require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Models/Product.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';

$path = parse_url(
    $_SERVER['REQUEST_URI'] ?? '/',
    PHP_URL_PATH
) ?: '/';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// API: return product data as JSON.
if ($method === 'GET' && $path === '/api/products') {
    $productModel = new Product($pdo);
    $controller = new ProductController($productModel);

    $controller->apiIndex();
    exit;
}

// Web page: return product data as HTML.
if ($method === 'GET' && $path === '/products') {
    $productModel = new Product($pdo);
    $controller = new ProductController($productModel);

    $controller->index();
    exit;
}

http_response_code(404);
header('content-type: text/plain; charset=utf-8');

echo 'Halaman tidak ditemukan.';
