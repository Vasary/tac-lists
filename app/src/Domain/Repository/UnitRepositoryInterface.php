<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Unit;
use Ramsey\Uuid\UuidInterface;

interface UnitRepositoryInterface
{
    public function get(UuidInterface $id): ?Unit;

    public function all(): array;
}
