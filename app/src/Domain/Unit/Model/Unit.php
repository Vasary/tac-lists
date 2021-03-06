<?php

namespace App\Domain\Unit\Model;

use App\Domain\Shared\Traits\RegionCode;
use App\Domain\Shared\Traits\TimestampedEntity;
use App\Domain\Shared\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class Unit
{
    use TimestampedEntity, UUIDIdentifier, RegionCode;

    protected UnicodeString $name;
    protected UnicodeString $short;
    protected Collection $items;
    protected array $values;

    public function __construct(UnicodeString $name, UnicodeString $short, UnicodeString $region, UuidV4 $id, array $values)
    {
        $this->id = $id;
        $this->name = $name;
        $this->short = $short;
        $this->region = $region;
        $this->values = $values;
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
