<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;

final class ImageNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Image %s not found', $id), ErrorCodes::IMAGE_NOT_FOUND);
    }
}
