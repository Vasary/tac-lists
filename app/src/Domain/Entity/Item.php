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

    protected Template $template;

    protected ShoppingList $list;

    protected Unit $unit;

    protected Collection $labels;

    protected Collection $geoPoints;

    protected Collection $images;

    public function __construct(Template $template, ShoppingList $list, Unit $units, int $value)
    {
        $this->template = $template;
        $this->list = $list;
        $this->unit = $units;
        $this->isPurchased = false;
        $this->ordering = 0;
        $this->value = $value;

        $this->labels = new ArrayCollection();
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

    public function template(): Template
    {
        return $this->template;
    }

    public function list(): ShoppingList
    {
        return $this->list;
    }

    public function unit(): Unit
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
