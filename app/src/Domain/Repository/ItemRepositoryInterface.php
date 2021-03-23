<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Item;
use App\Domain\Entity\ShoppingList;
use App\Domain\Entity\Template;
use App\Domain\Entity\Unit;
use Symfony\Component\Uid\UuidV4;

interface ItemRepositoryInterface
{
    public function create(Template $template, ShoppingList $list, Unit $unit, int $value, UuidV4 $id): Item;

    public function update(Item $item): void;

    public function get(UuidV4 $id): Item | null;

    public function delete(Item $item): void;
}
