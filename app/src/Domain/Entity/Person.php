<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Person
{
    use TimestampedEntity, UUIDIdentifier;

    protected Collection $lists;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->lists = new ArrayCollection();
    }


    public function lists(): Collection
    {
        return $this->lists;
    }
}
