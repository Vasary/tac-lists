<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class CategoryNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Category %s not found', $id), ErrorCodes::CATEGORY_NOT_FOUND);
    }
}
