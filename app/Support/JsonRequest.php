<?php

declare(strict_types=1);

namespace App\Support;

final class JsonRequest
{
    public static function decode(): array
    {
        $contentType = strtolower(
            trim(explode(";", $_SERVER["CONTENT_TYPE"] ?? '')[0])
        );

        if ($contentType !== 'application/json') {
            throw new HttpException(
                'Content-Type harus application/json.',
                415
            );
        }

        $rawBody = file_get_contents('php://input');

        if ($rawBody === false || trim($rawBody) === '') {
            throw new HttpException(
                'Body reques tidak boleh kosong.',
                400
            );
        }

        try {
            $payload = json_decode(
                $rawBody,
                false,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException) {
            throw new HttpException(
                'Format JSON tidak valid.',
                400
            );
        }

        if (!is_object($payload)) {
            throw new HttpException(
                'Body harus berupa objek JSON.',
                422
            );
        }

        return get_object_vars($payload);
    }
}
