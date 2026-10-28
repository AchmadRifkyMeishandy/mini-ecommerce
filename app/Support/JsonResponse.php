<?php

declare(strict_types=1);

namespace App\Support;

final class JsonResponse
{
    public static function send(
        array $payload,
        int $status = 200,
        ?string $location = null,
    ): void {
        http_response_code($status);

        header('Content-Type: application/json; charset=utf-8');

        if ($location !== null) {
            header('Location: ' . $location);
        }

        echo json_encode(
            $payload,
            JSON_PRETTY_PRINT |
                JSON_UNESCAPED_SLASHES |
                JSON_UNESCAPED_UNICODE
        );
    }
}
