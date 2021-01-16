<?php

declare(strict_types=1);

namespace App\Application\Template\Command;

use App\Domain\Command\AbstractCommand;
use Symfony\Component\String\UnicodeString;

final class CreateCommand extends AbstractCommand
{
    private UnicodeString $name;

    private UnicodeString $icon;

    private UnicodeString $author;

    private UnicodeString $category;

    private array $images;

    public function __construct(
        UnicodeString $name,
        UnicodeString $icon,
        UnicodeString $author,
        UnicodeString $category,
        array $images
    ) {
        $this->name = $name;
        $this->icon = $icon;
        $this->author = $author;
        $this->category = $category;
        $this->images = $images;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function icon(): UnicodeString
    {
        return $this->icon;
    }

    public function author(): UnicodeString
    {
        return $this->author;
    }

    public function category(): UnicodeString
    {
        return $this->category;
    }

    public function images(): array
    {
        return $this->images;
    }
}
