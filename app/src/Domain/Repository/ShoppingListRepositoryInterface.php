<?php

namespace App\Domain\Repository;

use App\Domain\Entity\ShoppingList;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface ShoppingListRepositoryInterface
{
    public function create(UnicodeString $name): ShoppingList;

    public function get(UuidV4 $id): ShoppingList | null;

    public function update(ShoppingList $list): void;
}
