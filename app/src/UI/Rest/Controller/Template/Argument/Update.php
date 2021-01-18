<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template\Argument;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class Update
{
    private UuidV4 $id;

    private UnicodeString $name;

    private UuidV4 $category;

    private UnicodeString $icon;

    private array $images;

    public function __construct(
        UuidV4 $id,
        UuidV4 $category,
        UnicodeString $name,
        UnicodeString $icon,
        array $images
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->icon = $icon;
        $this->images = $images;
    }

    public function id(): UuidV4
    {
        return $this->id;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function category(): UuidV4
    {
        return $this->category;
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
