<?php

declare(strict_types=1);

namespace App\Application\Person\Provider;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepositoryInterface;
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
        return $this->repository->get($id);
    }
}
