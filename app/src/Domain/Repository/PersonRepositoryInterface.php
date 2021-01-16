<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Person;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface PersonRepositoryInterface
{
    public function create(UuidV4 $id, UnicodeString $region): Person;

    public function get(UuidV4 $id): Person | null;
}
