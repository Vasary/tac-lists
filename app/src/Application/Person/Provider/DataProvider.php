<?php

declare(strict_types=1);

namespace App\Application\Person\Provider;

use App\Domain\Exception\PersonNotFoundException;
use App\Domain\Person\Model\Person;
use App\Domain\Person\Repository\PersonRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class DataProvider
{
    private PersonRepositoryInterface $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(UuidV4 $id): Person
    {
        if (null === $person = $this->repository->get($id)) {
            throw new PersonNotFoundException($id);
        }

        return $person;
    }
}
