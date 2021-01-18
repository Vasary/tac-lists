<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Unit;
use Symfony\Component\Uid\UuidV4;

interface UnitRepositoryInterface
{
    public function get(UuidV4 $id): Unit | null;

    public function all(): array;
}
