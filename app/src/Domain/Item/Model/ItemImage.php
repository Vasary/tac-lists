<?php

namespace App\Domain\Item\Model;

use App\Domain\Shared\Traits\TimestampedEntity;
use App\Domain\Shared\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class ItemImage
{
    use TimestampedEntity, UUIDIdentifier;

    protected UnicodeString $link;
    protected Item $item;

    public function __construct(UnicodeString $link, Item $item, UuidV4 $id)
    {
        $this->id = $id;
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
