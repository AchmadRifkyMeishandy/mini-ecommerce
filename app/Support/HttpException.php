<?php

namespace App\Support;

use RuntimeException;

final class HttpException extends RuntimeException
{
    public function __construct(
        string $message,
        public readonly int $statusCode
    ) {
        parent::__construct($message);
    }
}
