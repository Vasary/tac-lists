<?php

declare(strict_types=1);

namespace App\Application\Unit\Query;

use Symfony\Component\Uid\UuidV4;

final class UnitQuery
{
    public function __construct(private UuidV4 $id)
    {
    }

    public function id(): UuidV4
    {
        return $this->id;
    }
}
