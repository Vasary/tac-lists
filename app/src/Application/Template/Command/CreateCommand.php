<?php

declare(strict_types=1);

namespace App\Application\Template\Command;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CreateCommand
{
    public function __construct(
        private UnicodeString $name,
        private UnicodeString $icon,
        private UuidV4 $author,
        private UuidV4 $category,
        private array $images
    ) {
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function icon(): UnicodeString
    {
        return $this->icon;
    }

    public function author(): UuidV4
    {
        return $this->author;
    }

    public function category(): UuidV4
    {
        return $this->category;
    }

    public function images(): array
    {
        return $this->images;
    }
}
