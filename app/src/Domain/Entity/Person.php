<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Person
{
    use TimestampedEntity, UUIDIdentifier;

    protected UuidInterface $id;

    protected Collection $lists;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
        $this->lists = new ArrayCollection();
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function lists(): Collection
    {
        return $this->lists;
    }
}
