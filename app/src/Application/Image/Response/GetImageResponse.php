<?php

declare(strict_types=1);

namespace App\Application\Image\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;

final class GetImageResponse extends AbstractResponse
{
    public UnicodeString $id;

    public UnicodeString $name;

    public DateTimeImmutable $created;

    public DateTimeImmutable $updated;

    public function __construct(UnicodeString $id, UnicodeString $name, DateTimeImmutable $created, DateTimeImmutable $updated)
    {
        $this->id = $id;
        $this->name = $name;
        $this->created = $created;
        $this->updated = $updated;
    }
}
