<?php

namespace App\Domain\Entity\Traits;

use DateTimeInterface;

trait TimestampedEntity
{
    protected DateTimeInterface $createdAt;

    protected DateTimeInterface $updatedAt;

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}
