<?php

declare(strict_types=1);

namespace App\Application\List\Command;

use App\Domain\Command\AbstractCommand;
use Symfony\Component\String\UnicodeString;

final class CreateShoppingListCommand extends AbstractCommand
{
    private UnicodeString $name;

    private array $membersIds;

    public function __construct(UnicodeString $name, array $membersIds)
    {
        $this->name = $name;
        $this->membersIds = $membersIds;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function membersIds(): array
    {
        return $this->membersIds;
    }
}
