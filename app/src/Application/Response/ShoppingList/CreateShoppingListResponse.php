<?php

namespace App\Application\Response\ShoppingList;

use App\Application\Response\AbstractResponse;
use DateTimeImmutable;

final class CreateShoppingListResponse extends AbstractResponse
{
    public string $id;

    public string $name;

    public DateTimeImmutable $createdAt;

    public DateTimeImmutable $updatedAt;
}
