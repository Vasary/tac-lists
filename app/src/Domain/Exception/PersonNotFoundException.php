<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;

final class PersonNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Person %s not found', $id), ErrorCodes::PERSON_NOT_FOUND);
    }
}
