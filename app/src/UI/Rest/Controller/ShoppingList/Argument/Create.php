<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList\Argument;

use Symfony\Component\String\UnicodeString;

final class Create
{
    public function __construct(private UnicodeString $name, private array $members)
    {
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
