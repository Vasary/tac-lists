<?php

declare(strict_types=1);

namespace App\Application\Unit\Query;

use App\Domain\Query\AbstractQuery;
use Symfony\Component\Uid\UuidV4;

final class UnitsQuery extends AbstractQuery
{
    public function __construct(private UuidV4 $initiator) {}

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }
}
