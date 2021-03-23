<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Item;
use App\Domain\Entity\ItemImage;
use App\Domain\Repository\ItemImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class ItemImageRepository extends ServiceEntityRepository implements ItemImageRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemImage::class);

        $this->manager = $registry;
    }

    public function create(Item $item, UnicodeString $imageURL, UuidV4 $id): ItemImage
    {
        $item = new ItemImage($imageURL, $item, $id);

        $this->manager->getManager()->persist($item);
        $this->manager->getManager()->flush();

        return $item;
    }

    public function delete(ItemImage $image): void
    {
        $this->manager->getManager()->remove($image);
        $this->manager->getManager()->flush();
    }

    public function get(UuidV4 $id): ItemImage
    {
        return $this->findOneBy(['id' => $id]);
    }
}
