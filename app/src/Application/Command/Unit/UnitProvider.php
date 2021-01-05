<?php

namespace App\Application\Command\Unit;

use App\Domain\Entity\Unit;
use App\Domain\Exception\UnitNotFoundException;
use App\Domain\Repository\UnitRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final class UnitProvider
{
    private UnitRepositoryInterface $repository;

    public function __construct(UnitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(UuidInterface $id): Unit
    {
        if (null === $unit = $this->repository->get($id)) {
            throw new UnitNotFoundException($id);
        }

        return $unit;
    }

    public function getAll(): array
    {
        return $this->repository->all();
    }
}
