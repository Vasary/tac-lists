<?php

declare(strict_types=1);

namespace App\Application\Person\Command;

use App\Domain\Command\AbstractCommand;
use App\Domain\Entity\ShoppingList;
use Symfony\Component\String\UnicodeString;

final class AddToListCommand extends AbstractCommand
{
    private ShoppingList $list;

    private UnicodeString $personId;

    public function __construct(ShoppingList $list, UnicodeString $personId)
    {
        $this->list = $list;
        $this->personId = $personId;
    }

    public function list(): ShoppingList
    {
        return $this->list;
    }

    public function personId(): UnicodeString
    {
        return $this->personId;
    }
}
