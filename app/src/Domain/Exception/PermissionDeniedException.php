<?php

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class PermissionDeniedException extends DomainException
{
    #[Pure]
    public function __construct(UuidV4 $person, UuidV4 $object)
    {
        parent::__construct(
            sprintf('Person %s have no permission to %s ', $person, $object), SystemCodes::PERMISSION_DENIED
        );
    }
}
