<?php

declare(strict_types=1);

namespace App\Application\Unit\Provider;

use App\Domain\Entity\Unit;
use App\Domain\Exception\UnitNotFoundException;
use App\Domain\Repository\UnitRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class UnitProvider
{
    public function __construct(private UnitRepositoryInterface $repository) {}

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
}
