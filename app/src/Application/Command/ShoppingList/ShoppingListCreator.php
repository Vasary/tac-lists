<?php

namespace App\Application\Command\ShoppingList;

use App\Domain\Entity\ShoppingList;
use App\Infrastructure\Persistence\Doctrine\ShoppingListRepository;
use Symfony\Component\String\UnicodeString;

final class ShoppingListCreator
{
    private ShoppingListRepository $repository;

    public function __construct(ShoppingListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UnicodeString $string): ShoppingList
    {
        return new ShoppingList();
    }
}
