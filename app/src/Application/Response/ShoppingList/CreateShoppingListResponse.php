<?php

namespace App\Application\Response\ShoppingList;

use App\Application\Response\AbstractResponse;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class CreateShoppingListResponse extends AbstractResponse
{
    public UuidInterface $id;

    public string $name;

    public DateTimeImmutable $createdAt;

    public DateTimeImmutable $updatedAt;
}
