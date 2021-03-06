<?php

declare(strict_types=1);

namespace App\Application\List\Creator;

use App\Domain\Item\Model\Item;
use App\Domain\Item\Repository\ItemRepositoryInterface;
use App\Domain\Exception\PersonNotFoundException;
use App\Domain\Person\Model\Person;
use App\Domain\Person\Repository\PersonRepositoryInterface;
use App\Domain\ShoppingList\Model\ShoppingList;
use App\Infrastructure\Persistence\Doctrine\ShoppingListRepository;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class ShoppingListCreator
{
    public function __construct(
        private ShoppingListRepository $repository,
        private PersonRepositoryInterface $personRepository,
        private ItemRepositoryInterface $itemRepository,
    ) {
    }

    public function create(UnicodeString $name): ShoppingList
    {
        return $this->repository->create($name);
    }

    public function addToList(ShoppingList $list, UuidV4 $personId): void
    {
        if (null === $person = $this->personRepository->get($personId)) {
            throw new PersonNotFoundException($personId);
        }

        $list->members()->add($person);

        $this->repository->update($list);
    }

    public function excludePersonFromList(ShoppingList $list, UuidV4 $personId): void
    {
        $personExists = $list->members()->exists($this->comparePersons($personId));
        if (!$personExists) {
            throw new PersonNotFoundException($personId);
        }

        $memberIndex = null;
        foreach ($list->members()->toArray() as $index => $member) {
            /** @var Person $member */
            if ($this->comparePersons($personId)($index, $member)) {
                $list->members()->removeElement($member);
                break;
            }
        }

        $this->repository->update($list);
    }

    public function rename(UnicodeString $newName, ShoppingList $list): void
    {
        $list->applyName($newName);

        $this->repository->update($list);
    }

    public function removeItem(ShoppingList $list, Item $item): void
    {
        $list->items()->removeElement($item);
        $this->itemRepository->delete($item);

        $this->repository->update($list);
    }

    private function comparePersons(UuidV4 $id): callable
    {
        return fn (int $_, Person $person) => $person->id()->toBinary() === $id->toBinary();
    }
}
