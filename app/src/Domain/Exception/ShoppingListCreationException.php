<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;

final class ShoppingListCreationException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Shopping list creation error', SystemCodes::SHOPPING_LIST_CREATION_ERROR);
    }
}
