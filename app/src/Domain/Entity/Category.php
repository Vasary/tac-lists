<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\RegionCode;
use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;

class Category
{
    use TimestampedEntity, UUIDIdentifier, RegionCode;

    protected UnicodeString $name;

    protected UnicodeString $marker;

    protected Collection $registries;

    public function __construct(UnicodeString $name, UnicodeString $marker, UnicodeString $region)
    {
        $this->name = $name;
        $this->marker = $marker;
        $this->region = $region;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function marker(): string
    {
        return $this->marker;
    }

    public function registries(): Collection
    {
        return $this->registries;
    }
}
