<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template\Argument;

use Symfony\Component\String\UnicodeString;

final class Create
{
    private UnicodeString $name;

    private UnicodeString $category;

    private UnicodeString $author;

    private UnicodeString $icon;

    private array $images;

    public function __construct(
        UnicodeString $name,
        UnicodeString $category,
        UnicodeString $author,
        UnicodeString $icon,
        array $images
    ) {
        $this->name = $name;
        $this->category = $category;
        $this->author = $author;
        $this->icon = $icon;
        $this->images = $images;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function category(): UnicodeString
    {
        return $this->category;
    }

    public function author(): UnicodeString
    {
        return $this->author;
    }

    public function icon(): UnicodeString
    {
        return $this->icon;
    }

    public function images(): array
    {
        return $this->images;
    }
}
