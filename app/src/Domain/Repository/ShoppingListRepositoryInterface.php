<?php

namespace App\Domain\Repository;

use App\Domain\Entity\ShoppingList;
use Symfony\Component\String\UnicodeString;

interface ShoppingListRepositoryInterface
{
    public function create(UnicodeString $name): ShoppingList;
}
