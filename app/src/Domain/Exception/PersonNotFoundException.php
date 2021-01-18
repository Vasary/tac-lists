<?php

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class PersonNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Person %s not found', $id), SystemCodes::PERSON_NOT_FOUND);
    }
}
