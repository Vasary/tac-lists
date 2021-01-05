<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;

final class UnitNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Unit %s not found', $id), ErrorCodes::UNIT_NOT_FOUND);
    }
}
