<?php

declare(strict_types=1);

namespace App\Application\List\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;

final class CreateShoppingListResponse extends AbstractResponse
{
    public string $id;

    public string $name;

    public DateTimeImmutable $createdAt;

    public DateTimeImmutable $updatedAt;
}
