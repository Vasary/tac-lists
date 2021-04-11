<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\RegionCode;
use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class Category
{
    use TimestampedEntity;
    use UUIDIdentifier;
    use RegionCode;

    protected UnicodeString $name;
    protected UnicodeString $marker;
    protected Collection $templates;

    public function __construct(UnicodeString $name, UnicodeString $marker, UnicodeString $region, UuidV4 $id)
    {
        $this->id = $id;
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
