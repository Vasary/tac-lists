<?php

namespace App\Domain\Entity\Traits;

use Symfony\Component\Uid\UuidV4;

trait UUIDIdentifier
{
    protected UuidV4 $id;

    public function id(): UuidV4
    {
        return $this->id;
    }
}
