<?php

declare(strict_types=1);

namespace App\Application\Unit\Provider;

use App\Domain\Exception\UnitNotFoundException;
use App\Domain\Person\Repository\PersonRepositoryInterface;
use App\Domain\Unit\Model\Unit;
use App\Domain\Unit\Repository\UnitRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class UnitProvider
{
    public function __construct(
        private UnitRepositoryInterface $repository,
        private PersonRepositoryInterface $personRepository
    ) {
    }

    public function get(UuidV4 $id): Unit
    {
        if (null === $unit = $this->repository->get($id)) {
            throw new UnitNotFoundException($id);
        }

        return $unit;
    }

    public function all(): array
    {
        return $this->repository->all();
    }

    public function regional(UuidV4 $person): \Generator
    {
        return $this->repository->regional($this->personRepository->get($person)->region());
    }
}
