<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\GeoPoint;
use App\Domain\Entity\Item;
use App\Domain\Repository\PointRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PointRepository extends ServiceEntityRepository implements PointRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeoPoint::class);

        $this->manager = $registry;
    }

    public function get(UuidV4 $id): GeoPoint | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function create(float $longitude, float $latitude, Item $item, UnicodeString $comment, UuidV4 $id): GeoPoint
    {
        $point = new GeoPoint($latitude, $longitude, $comment, $item, $id);

        $this->manager->getManager()->persist($point);
        $this->manager->getManager()->flush();

        return $point;
    }

    public function delete(GeoPoint $point): void
    {
        $this->manager->getManager()->remove($point);
        $this->manager->getManager()->flush();
    }
}
