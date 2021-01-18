<?php

declare(strict_types=1);

namespace App\Application\List\Provider;

use App\Domain\Entity\ShoppingList;
use App\Domain\Exception\ListNotFoundException;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\ShoppingListRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class Provider
{
    public function __construct(
        private ShoppingListRepositoryInterface $repository,
        private PersonRepositoryInterface $personRepository
    ) {}

    public function get(UuidV4 $id): ShoppingList
    {
        if (null === $list = $this->repository->get($id)) {
            throw new ListNotFoundException($id);
        }

        return $list;
    }
}