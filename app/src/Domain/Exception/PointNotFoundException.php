<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use Symfony\Component\Uid\UuidV4;

final class PointNotFoundException extends DomainException
{
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Point %s not found', $id), SystemCodes::POINT_NOT_FOUND);
    }
}
