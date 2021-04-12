<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use Symfony\Component\Uid\UuidV4;

final class PermissionDeniedException extends DomainException
{
    public function __construct(UuidV4 $person, UuidV4 $object)
    {
        parent::__construct(
            sprintf('Person %s have no permission to %s ', $person, $object), SystemCodes::PERMISSION_DENIED
        );
    }
}
