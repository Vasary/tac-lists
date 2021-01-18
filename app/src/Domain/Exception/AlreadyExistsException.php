<?php

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class AlreadyExistsException extends DomainException
{
    #[Pure]
    public function __construct(UuidV4 $item, UuidV4 $in)
    {
        parent::__construct(sprintf('%s already exists in %s', $item, $in), SystemCodes::ALREADY_EXISTS);
    }
}
