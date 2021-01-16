<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList\Argument;

use Symfony\Component\String\UnicodeString;

final class Create
{
    private UnicodeString $name;

    private array $members;

    public function __construct(UnicodeString $name, array $members)
    {
        $this->name = $name;
        $this->members = $members;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function members(): array
    {
        return $this->members;
    }
}
