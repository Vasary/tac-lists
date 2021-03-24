<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;

class ShoppingList
{
    use TimestampedEntity, UUIDIdentifier;

    private UnicodeString $name;
    private Collection $items;
    private Collection $members;

    public function __construct(UnicodeString $name)
    {
        $this->name = $name;
        $this->items = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function items(): Collection
    {
        return $this->items;
    }

    public function members(): Collection
    {
        return $this->members;
    }

    public function applyName(UnicodeString $name): void
    {
        $this->name = $name;
    }
}
