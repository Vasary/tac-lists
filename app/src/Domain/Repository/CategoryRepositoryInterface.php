<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Category;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface CategoryRepositoryInterface
{
    public function create(UnicodeString $name, UnicodeString $color, UnicodeString $region, UuidV4 $id): Category;

    public function get(UuidV4 $id): Category | null;

    public function all(): array;

    public function regional(UnicodeString $region): \Generator;
}
