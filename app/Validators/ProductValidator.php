<?php

declare(strict_types=1);

namespace App\Validators;

use App\Support\HttpException;

final class ProductValidator
{

    public static function validateFilters(array $query): array
    {
        $search = null;
        $categoryId = null;
        $page = 1;
        $perPage = 10;

        // Validasi parameter pencarian.
        if (array_key_exists('search', $query)) {
            if (!is_string($query['search'])) {
                throw new HttpException(
                    'Parameter search harus berupa teks.',
                    422
                );
            }

            $search = trim($query['search']);

            if (mb_strlen($search, 'UTF-8') > 150) {
                throw new HttpException(
                    'Pencarian maksimal 150 karakter.',
                    422
                );
            }

            if ($search === '') {
                $search = null;
            }
        }

        // Validasi parameter kategori.
        if (
            array_key_exists('category_id', $query)
            && $query['category_id'] !== ''
        ) {
            $categoryId = filter_var(
                $query['category_id'],
                FILTER_VALIDATE_INT
            );

            if ($categoryId === false || $categoryId < 1) {
                throw new HttpException(
                    'category_id harus berupa angka positif.',
                    422
                );
            }
        }

        // Validasi nomor halaman.
        if (array_key_exists('page', $query)) {
            $page = filter_var(
                $query['page'],
                FILTER_VALIDATE_INT
            );

            if ($page === false || $page < 1) {
                throw new HttpException(
                    'page harus berupa angka bulat minimal 1.',
                    422
                );
            }
        }

        // Validasi jumlah produk per halaman.
        if (array_key_exists('per_page', $query)) {
            $perPage = filter_var(
                $query['per_page'],
                FILTER_VALIDATE_INT
            );

            if (
                $perPage === false
                || $perPage < 1
                || $perPage > 100
            ) {
                throw new HttpException(
                    'per_page harus berupa angka antara 1 sampai 100',
                    422
                );
            }
        }

        // Pastikan offset tidak melebihi batas integer PHP.
        if (($page - 1) > intdiv(PHP_INT_MAX, $perPage)) {
            throw new HttpException(
                'Nomor halaman terlalu besar.',
                422
            );
        }

        return [
            'search' => $search,
            'category_id' => $categoryId,
            'page' => $page,
            'per_page' => $perPage,
        ];
    }

    public static function validateForUpdate(array $payload): array
    {
        if (!isset($payload['stock'])) {
            throw new HttpException(
                'Stock wajib diisi saat memperbarui produk.',
                422
            );
        }

        return self::validateForCreate($payload);
    }
    public static function validateForCreate(array $payload): array
    {
        if (
            !isset(
                $payload['category_id'],
                $payload['name'],
                $payload['slug'],
                $payload['price']
            )
        ) {
            throw new HttpException(
                'category_id, name, slug, dan price wajib diisi.',
                422
            );
        }

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
            throw new HttpException(
                'Data produk tidak valid.',
                422
            );
        }

        return [
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'stock' => $stock,
        ];
    }
}
