<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class GeoPoint
{
    use TimestampedEntity;
    use UUIDIdentifier;

    protected float $latitude;
    protected float $longitude;
    protected UnicodeString $comment;
    protected Item $item;

    public function __construct(float $latitude, float $longitude, UnicodeString $comment, Item $item, UuidV4 $id)
    {
        $this->id = $id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->comment = $comment;
        $this->item = $item;
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function comment(): null | UnicodeString
    {
        return $this->comment;
    }

    public function item(): Item
    {
        return $this->item;
    }
}
