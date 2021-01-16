<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Unit;

interface UnitRepositoryInterface
{
    public function get(string $id): Unit | null;

    public function all(): array;
}
