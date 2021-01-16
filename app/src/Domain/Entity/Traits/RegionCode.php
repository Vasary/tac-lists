<?php

namespace App\Domain\Entity\Traits;

use Symfony\Component\String\UnicodeString;

trait RegionCode
{
    protected UnicodeString $region;

    public function region(): UnicodeString
    {
        return $this->region;
    }
}
