<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Unit;
use App\Domain\Repository\UnitRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class UnitRepository extends ServiceEntityRepository implements UnitRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unit::class);

        $this->manager = $registry;
    }

    public function create(UnicodeString $name, UnicodeString $short, UnicodeString $region, UuidV4 $id, array $values = []): Unit
    {
        $unit = new Unit($name, $short, $region, $id, $values);

        $this->manager->getManager()->persist($unit);

        return $unit;
    }

    public function get(UuidV4 $id): Unit | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }

    public function regional(UnicodeString $region): \Generator
    {
        return
            $this
                ->createQueryBuilder('u')
                ->where('u.region = :region')
                ->addOrderBy('u.name', 'ASC')
                ->setParameter('region', $region)
                ->getQuery()
                ->toIterable()
            ;
    }
}
