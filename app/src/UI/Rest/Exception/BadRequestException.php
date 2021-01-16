<?php

declare(strict_types=1);

namespace App\UI\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class BadRequestException extends BadRequestHttpException
{
    private array $errors;

    public function __construct(array $errors, \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct('There are validation errors exists', $previous, 400, $headers);

        $this->errors = $errors;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
