<?php

namespace App\Domain\ShoppingList\Repository;

use App\Domain\ShoppingList\Model\ShoppingList;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface ShoppingListRepositoryInterface
{
    public function create(UnicodeString $name, ?UuidV4 $id = null): ShoppingList;
    public function get(UuidV4 $id): ShoppingList | null;
    public function update(ShoppingList $list): void;
}
