<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;

final class CategoryNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Category %s not found', $id), ErrorCodes::CATEGORY_NOT_FOUND);
    }
}
