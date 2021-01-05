<?php

declare(strict_types=1);

namespace App\Application\Request\ShoppingList;

use App\Application\Request\AbstractRequest;

final class CreateShoppingListRequest extends AbstractRequest
{
    public string $name;
}
