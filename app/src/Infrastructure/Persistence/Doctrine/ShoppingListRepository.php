<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\ShoppingList;
use App\Domain\Repository\ShoppingListRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class ShoppingListRepository extends ServiceEntityRepository implements ShoppingListRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingList::class);

        $this->manager = $registry;
    }

    public function create(UnicodeString $name): ShoppingList
    {
        $list = new ShoppingList($name);

        $this->manager->getManager()->persist($list);
        $this->manager->getManager()->flush();

        return $list;
    }

    public function get(UuidV4 $id): ShoppingList | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function update(ShoppingList $list): void
    {
        $this->manager->getManager()->persist($list);
        $this->manager->getManager()->flush();
    }
}
