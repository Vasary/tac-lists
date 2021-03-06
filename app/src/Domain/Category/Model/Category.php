<?php

namespace App\Domain\Category\Model;

use App\Domain\Shared\Traits\RegionCode;
use App\Domain\Shared\Traits\TimestampedEntity;
use App\Domain\Shared\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class Category
{
    use TimestampedEntity, UUIDIdentifier, RegionCode;

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
