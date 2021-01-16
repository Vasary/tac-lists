<?php

declare(strict_types=1);

namespace App\Application\Category\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;

final class GetCategoryResponse extends AbstractResponse
{
    public UnicodeString $id;

    public UnicodeString $name;

    public UnicodeString $color;

    public UnicodeString $region;

    public DateTimeImmutable $created;

    public DateTimeImmutable $updated;

    public function __construct(UnicodeString $id, UnicodeString $name, UnicodeString $color, UnicodeString $region, DateTimeImmutable $created, DateTimeImmutable $updated)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->region = $region;
        $this->created = $created;
        $this->updated = $updated;
    }
}