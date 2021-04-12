<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use Symfony\Component\Uid\UuidV4;

final class AlreadyExistsException extends DomainException
{
    public function __construct(UuidV4 $item, UuidV4 $in)
    {
        parent::__construct(sprintf('%s already exists in %s', $item, $in), SystemCodes::ALREADY_EXISTS);
    }
}
