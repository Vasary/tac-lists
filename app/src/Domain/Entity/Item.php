<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Item
{
    use TimestampedEntity, UUIDIdentifier;

    protected bool $isPurchased;

    protected int $ordering;

    protected int $value;

    protected Registry $registry;

    protected ShoppingList $list;

    protected Unit $unit;

    protected Collection $labels;

    protected Collection $geoPoints;

    protected Collection $images;

    public function __construct(Registry $registry, ShoppingList $list, Unit $units, Collection $labels, int $value)
    {
        $this->registry = $registry;
        $this->list = $list;
        $this->unit = $units;
        $this->labels = $labels;
        $this->isPurchased = false;
        $this->ordering = 0;
        $this->value = $value;

        $this->geoPoints = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function isPurchased(): bool
    {
        return $this->isPurchased;
    }

    public function ordering(): int
    {
        return $this->ordering;
    }

    public function registry(): Registry
    {
        return $this->registry;
    }

    public function list(): ShoppingList
    {
        return $this->list;
    }

    public function units(): Unit
    {
        return $this->unit;
    }

    public function labels(): Collection
    {
        return $this->labels;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function geoPoints(): Collection
    {
        return $this->geoPoints;
    }

    public function images(): Collection
    {
        return $this->images;
    }
}
