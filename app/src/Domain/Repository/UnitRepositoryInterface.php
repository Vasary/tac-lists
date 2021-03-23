<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Unit;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface UnitRepositoryInterface
{
    public function create(UnicodeString $name, UnicodeString $short, UnicodeString $region, UuidV4 $id, array $values = []): Unit;

    public function get(UuidV4 $id): Unit | null;

    public function all(): array;

    public function regional(UnicodeString $region): \Generator;
}
