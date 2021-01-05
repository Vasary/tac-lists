<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\RegionCode;
use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;

class Unit
{
    use TimestampedEntity, UUIDIdentifier, RegionCode;

    protected UnicodeString $name;

    protected UnicodeString $short;

    protected Collection $items;

    protected array $values;

    public function __construct(UnicodeString $name, UnicodeString $short, UnicodeString $region)
    {
        $this->name = $name;
        $this->short = $short;
        $this->region = $region;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function shortName(): string
    {
        return $this->short;
    }

    public function items(): string
    {
        return $this->items;
    }

    public function values(): array
    {
        return $this->values;
    }
}
