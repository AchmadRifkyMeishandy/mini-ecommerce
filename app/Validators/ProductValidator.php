<?php

declare(strict_types=1);

namespace App\Validators;

use App\Support\HttpException;

final class ProductValidator
{
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
