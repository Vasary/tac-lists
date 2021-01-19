<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;

class ItemImage
{
    use TimestampedEntity, UUIDIdentifier;

    protected UnicodeString $link;

    protected Item $item;

    public function __construct(UnicodeString $link, Item $item)
    {
        $this->link = $link;
        $this->item = $item;
    }

    public function link(): UnicodeString
    {
        return $this->link;
    }

    public function item(): Item
    {
        return $this->item;
    }
}
