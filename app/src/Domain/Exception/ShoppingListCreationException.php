<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;

final class ShoppingListCreationException extends DomainException
{
    #[Pure]
    public function __construct()
    {
        parent::__construct('Shopping list creation error', ErrorCodes::SHOPPING_LIST_CREATION_ERROR);
    }
}
