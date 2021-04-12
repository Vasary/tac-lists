<?php

namespace App\Domain\Shared\Traits;

use Symfony\Component\String\UnicodeString;

trait RegionCode
{
    protected UnicodeString $region;

    public function region(): UnicodeString
    {
        return $this->region;
    }
}
