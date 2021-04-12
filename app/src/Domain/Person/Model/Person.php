<?php

namespace App\Domain\Person\Model;

use App\Domain\Shared\Traits\TimestampedEntity;
use App\Domain\Shared\Traits\UUIDIdentifier;
use App\Domain\ShoppingList\Model\ShoppingList;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class Person
{
    use TimestampedEntity, UUIDIdentifier;

    protected Collection $lists;

    protected UnicodeString $region;

    public function __construct(UuidV4 $id, UnicodeString $region)
    {
        $this->id = $id;
        $this->region = $region;
        $this->lists = new ArrayCollection();
    }

    public function lists(): Collection
    {
        return $this->lists;
    }

    public function region(): UnicodeString
    {
        return $this->region;
    }

    public function addToList(ShoppingList $list): void
    {
        $this->lists->add($list);
    }
}
