<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\RegionCode;
use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;

class Category
{
    use TimestampedEntity;
    use UUIDIdentifier;
    use RegionCode;

    protected UnicodeString $name;

    protected UnicodeString $marker;

    protected Collection $templates;

    public function __construct(UnicodeString $name, UnicodeString $marker, UnicodeString $region)
    {
        $this->name = $name;
        $this->marker = $marker;
        $this->region = $region;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function marker(): UnicodeString
    {
        return $this->marker;
    }

    public function templates(): Collection
    {
        return $this->templates;
    }
}
