<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

final class ApplicationResponse implements \JsonSerializable
{
    public function __construct(private string $message, private int $code)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'message' => $this->message,
            'code' => $this->code
        ];
    }
}
