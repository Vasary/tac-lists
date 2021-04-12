<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use Symfony\Component\Uid\UuidV4;

final class UnitNotFoundException extends DomainException
{
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Unit %s not found', $id), SystemCodes::UNIT_NOT_FOUND);
    }
}
