<?php

namespace App\Domain\Person\Repository;

use App\Domain\Person\Model\Person;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface PersonRepositoryInterface
{
    public function create(UuidV4 $id, UnicodeString $region): Person;
    public function get(UuidV4 $id): Person | null;
}
