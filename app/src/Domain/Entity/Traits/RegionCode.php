<?php

namespace App\Domain\Entity\Traits;

use Symfony\Component\String\UnicodeString;

trait RegionCode
{
    protected UnicodeString $region;

    public function region(): string
    {
        return $this->region;
    }
}
