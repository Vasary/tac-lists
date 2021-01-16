<?php

declare(strict_types=1);

namespace App\Application\Template\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CreateTemplateResponse extends AbstractResponse
{
    public UuidV4 $id;

    public UnicodeString $region;

    public UuidV4 $category;

    public UnicodeString $icon;

    public UuidV4 $author;

    public bool $common;

    public DateTimeImmutable $created;

    public DateTimeImmutable $updated;

    public function __construct(
        UuidV4 $id,
        UnicodeString $region,
        UuidV4 $category,
        UnicodeString $icon,
        UuidV4 $author,
        bool $common,
        DateTimeImmutable $created,
        DateTimeImmutable $updated
    ) {
        $this->id = $id;
        $this->region = $region;
        $this->category = $category;
        $this->icon = $icon;
        $this->author = $author;
        $this->common = $common;
        $this->created = $created;
        $this->updated = $updated;
    }
}
