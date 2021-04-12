<?php

namespace App\Domain\Label\Model;

use App\Domain\Shared\Traits\TimestampedEntity;
use App\Domain\Shared\Traits\UUIDIdentifier;
use App\Domain\Item\Model\Item;
use Symfony\Component\String\UnicodeString;

class Label
{
    use TimestampedEntity, UUIDIdentifier;

    protected UnicodeString $text;
    protected Item $item;

    public function __construct(UnicodeString $text, Item $item)
    {
        $this->text = $text;
        $this->item = $item;
    }

    public function text(): UnicodeString
    {
        return $this->text;
    }

    public function item(): Item
    {
        return $this->item;
    }
}
