<?php

namespace App\Domain\Entity\Traits;

use DateTimeImmutable;

trait TimestampedEntity
{
    protected DateTimeImmutable $created;

    protected DateTimeImmutable $updated;

    public function created(): DateTimeImmutable
    {
        return $this->created;
    }

    public function updated(): DateTimeImmutable
    {
        return $this->updated;
    }

    public function onPrePersist(): void
    {
        $this->created = new DateTimeImmutable();
        $this->updated = new DateTimeImmutable();
    }

    public function onPreUpdate(): void
    {
        $this->updated = new DateTimeImmutable();
    }
}

