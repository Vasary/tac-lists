<?php

declare(strict_types=1);

namespace App\Application\List\Request;

use App\Domain\Request\AbstractRequest;

final class CreateShoppingListRequest extends AbstractRequest
{
    public string $name;
}
