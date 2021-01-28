<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList\Argument;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class Rename
{
    public function __construct(
        private UuidV4 $list,
        private UnicodeString $name,
    ) {
    }

    public function list(): UuidV4
    {
        return $this->list;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }
}
