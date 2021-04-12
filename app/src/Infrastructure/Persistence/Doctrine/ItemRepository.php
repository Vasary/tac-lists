<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Item\Model\Item;
use App\Domain\Item\Repository\ItemRepositoryInterface;
use App\Domain\ShoppingList\Model\ShoppingList;
use App\Domain\Template\Model\Template;
use App\Domain\Unit\Model\Unit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\UuidV4;

final class ItemRepository extends ServiceEntityRepository implements ItemRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);

        $this->manager = $registry;
    }

    public function create(Template $template, ShoppingList $list, Unit $unit, int $value, UuidV4 $id): Item
    {
        $item = new Item($template, $list, $unit, $value, $id);

        $this->manager->getManager()->persist($item);
        $this->manager->getManager()->flush();

        return $item;
    }

    public function update(Item $item): void
    {
        $this->manager->getManager()->persist($item);
        $this->manager->getManager()->flush();
    }

    public function delete(Item $item): void
    {
        $this->manager->getManager()->remove($item);
        $this->manager->getManager()->flush();
    }

    public function get(UuidV4 $id): Item | null
    {
        return $this->findOneBy(['id' => $id]);
    }
}
