<?php

declare(strict_types=1);

namespace App\Application\Unit\Provider;

use App\Domain\Entity\Unit;
use App\Domain\Exception\UnitNotFoundException;
use App\Domain\Repository\UnitRepositoryInterface;

final class UnitProvider
{
    private UnitRepositoryInterface $repository;

    public function __construct(UnitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $id): Unit
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
