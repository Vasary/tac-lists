<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Category;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface CategoryRepositoryInterface
{
    public function create(UnicodeString $name, UnicodeString $color, UnicodeString $region): Category;

    public function get(UuidV4 $id): Category | null;

    public function all(): array;
}
