<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Item;
use App\Domain\Entity\ShoppingList;
use App\Domain\Entity\Template;
use App\Domain\Entity\Unit;

interface ItemRepositoryInterface
{
    public function create(Template $template, ShoppingList $list, Unit $unit, int $value): Item;
}
