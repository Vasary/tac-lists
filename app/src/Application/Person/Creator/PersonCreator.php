<?php

declare(strict_types=1);

namespace App\Application\Person\Creator;

use App\Domain\Person\Model\Person;
use App\Domain\Person\Repository\PersonRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PersonCreator
{
    private PersonRepositoryInterface $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(UuidV4 $id, UnicodeString $region): Person
    {
        return $this->repository->create($id, $region);
    }
}
