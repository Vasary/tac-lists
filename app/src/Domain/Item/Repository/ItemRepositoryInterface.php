<?php

namespace App\Domain\Item\Repository;

use App\Domain\Item\Model\Item;
use App\Domain\ShoppingList\Model\ShoppingList;
use App\Domain\Template\Model\Template;
use App\Domain\Unit\Model\Unit;
use Symfony\Component\Uid\UuidV4;

interface ItemRepositoryInterface
{
    public function create(Template $template, ShoppingList $list, Unit $unit, int $value, UuidV4 $id): Item;
    public function update(Item $item): void;
    public function get(UuidV4 $id): Item | null;
    public function delete(Item $item): void;
}
