<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;

class GeoPoint
{
    use TimestampedEntity, UUIDIdentifier;

    protected float $latitude;

    protected float $longitude;

    protected UnicodeString $comment;

    protected Item $item;

    public function __construct(float $latitude, float $longitude, UnicodeString $comment)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->comment = $comment;
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function comment(): ?string
    {
        return $this->comment;
    }

    public function item(): Item
    {
        return $this->item;
    }
}