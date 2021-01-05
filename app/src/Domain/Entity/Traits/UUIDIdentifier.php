<?php

namespace App\Domain\Entity\Traits;

trait UUIDIdentifier
{
    protected string $id;

    public function id(): string
    {
        return $this->id;
    }
}
