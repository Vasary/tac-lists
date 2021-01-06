<?php

declare(strict_types=1);

namespace App\Domain\Command;

use JsonException;

abstract class AbstractCommand
{
    public array $request;

    /**
     * @param string|null $requestParams
     * @throws JsonException
     */
    public function __construct(string $requestParams = null)
    {
        $this->request = [];

        if (null !== $requestParams) {
            $this->request = json_decode($requestParams, true, 512, JSON_THROW_ON_ERROR);
        }
    }
}
