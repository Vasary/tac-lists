<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;

class RegistryImage
{
    use TimestampedEntity, UUIDIdentifier;

    protected UnicodeString $link;

    protected Registry $registry;

    public function __construct(UnicodeString $link, Registry $registry)
    {
        $this->link = $link;
        $this->registry = $registry;
    }

    public function link(): string
    {
        return $this->link;
    }
}
