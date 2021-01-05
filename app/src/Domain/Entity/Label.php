<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
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

    public function text(): string
    {
        return $this->text;
    }

    public function item(): Item
    {
        return $this->item;
    }
}
