<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\ShoppingListRepositoryInterface;
use Behat\Behat\Context\Context;
use function Symfony\Component\String\u;
use Symfony\Component\Uid\UuidV4;

final class ShoppingListContext implements Context
{
    public function __construct(
        private ShoppingListRepositoryInterface $listRepository,
        private PersonRepositoryInterface $personRepository
    ) {
    }

    /**
     * @Given /^list (.*) with id (.*)$/
     */
    public function spawnList(string $name, string $id): void
    {
        $this->listRepository->create(u($name), UuidV4::fromString($id));
    }

    /**
     * @Given /^add person (.*) to list (.*)/
     */
    public function addMemberToList(string $member, string $list): void
    {
        $list = $this->listRepository->get(UuidV4::fromString($list));
        $person = $this->personRepository->get(UuidV4::fromString($member));

        $list->members()->add($person);
        $person->lists()->add($list);

        $this->listRepository->update($list);
    }
}
