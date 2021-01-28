<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\RegionCode;
use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;

class Template
{
    use TimestampedEntity;
    use UUIDIdentifier;
    use RegionCode;

    protected UnicodeString $name;

    protected Category $category;

    protected UnicodeString $icon;

    protected Collection $items;

    protected Person $author;

    protected bool $isCommon;

    protected Collection $images;

    public function __construct(UnicodeString $name, UnicodeString $icon, Category $category, Person $person, UnicodeString $region)
    {
        $this->name = $name;
        $this->icon = $icon;

        $this->category = $category;
        $this->author = $person;

        $this->isCommon = false;
        $this->region = $region;

        $this->images = new ArrayCollection();
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function icon(): UnicodeString
    {
        return $this->icon;
    }

    public function items(): Collection
    {
        return $this->items;
    }

    public function images(): Collection
    {
        return $this->images;
    }

    public function author(): Person
    {
        return $this->author;
    }

    public function common(): bool
    {
        return $this->isCommon;
    }

    public function applyName(UnicodeString $name): void
    {
        $this->name = $name;
    }

    public function applyCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function applyIcon(UnicodeString $icon): void
    {
        $this->icon = $icon;
    }
}
