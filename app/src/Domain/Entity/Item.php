<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\UuidV4;

class Item
{
    use TimestampedEntity;
    use UUIDIdentifier;

    protected bool $isPurchased;
    protected int $ordering;
    protected int $value;
    protected Template $template;
    protected ShoppingList $list;
    protected Unit $unit;
    protected Collection $labels;
    protected Collection $geoPoints;
    protected Collection $images;

    public function __construct(Template $template, ShoppingList $list, Unit $units, int $value, UuidV4 $id)
    {
        $this->id = $id;
        $this->template = $template;
        $this->list = $list;
        $this->unit = $units;
        $this->isPurchased = false;
        $this->value = $value;
        $this->ordering = 0;

        $this->labels = new ArrayCollection();
        $this->geoPoints = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function isPurchased(): bool
    {
        return $this->isPurchased;
    }

    public function order(): int
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

    public function points(): Collection
    {
        return $this->geoPoints;
    }

    public function images(): Collection
    {
        return $this->images;
    }

    public function applyBought(): void
    {
        $this->isPurchased = true;
    }

    public function applyNotBought(): void
    {
        $this->isPurchased = false;
    }

    public function applyUnit(Unit $unit): void
    {
        $this->unit = $unit;
    }

    public function applyOrder(int $order): void
    {
        $this->ordering = $order;
    }

    public function applyValue(int $value): void
    {
        $this->value = $value;
    }

    public function applyTemplate(Template $template): void
    {
        $this->template = $template;
    }

    public function applyList(ShoppingList $list): void
    {
        $this->list = $list;
    }
}
