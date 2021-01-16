<?php

declare(strict_types=1);

namespace App\Application\Category\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;

final class CreateCategoryResponse extends AbstractResponse
{
    public string $id;

    public string $name;

    public string $color;

    public string $region;

    public DateTimeImmutable $created;

    public DateTimeImmutable $updated;

    public function __construct(string $id, string $name, string $color, string $region, DateTimeImmutable $created, DateTimeImmutable $updated)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->region = $region;
        $this->created = $created;
        $this->updated = $updated;
    }
}