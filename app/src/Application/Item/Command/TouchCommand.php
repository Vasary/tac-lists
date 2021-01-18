<?php

declare(strict_types=1);

namespace App\Application\Item\Command;

use Symfony\Component\Uid\UuidV4;

final class TouchCommand
{
    public function __construct(
        private UuidV4 $id,
        private UuidV4 $initiator
    ) {}

    public function id(): UuidV4
    {
        return $this->id;
    }

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }
}