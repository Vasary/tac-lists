<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Unit;
use App\Domain\Repository\UnitRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class UnitRepository extends ServiceEntityRepository implements UnitRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unit::class);

        $this->manager = $registry;
    }

    public function get(string $id): Unit | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }
}
