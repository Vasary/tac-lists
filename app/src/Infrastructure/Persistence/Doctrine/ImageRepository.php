<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\ItemImage;
use App\Domain\Repository\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemImage::class);

        $this->manager = $registry;
    }

    public function get(string $id): ItemImage | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }
}
