<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Item;
use App\Domain\Entity\ShoppingList;
use App\Domain\Entity\Template;
use App\Domain\Entity\Unit;
use App\Domain\Repository\ItemRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ItemRepository extends ServiceEntityRepository implements ItemRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);

        $this->manager = $registry;
    }

    public function create(Template $template, ShoppingList $list, Unit $unit, int $value): Item
    {
        $item = new Item($template, $list, $unit, $value);

        $this->manager->getManager()->persist($item);
        $this->manager->getManager()->flush();

        return $item;
    }
}
