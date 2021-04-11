<?php

declare(strict_types=1);

namespace App\Application\Item\Query;

use Symfony\Component\Uid\UuidV4;

final class GetItemQuery
{
    public function __construct(private UuidV4 $item, private UuidV4 $initiator)
    {
    }

    public function item(): UuidV4
    {
        return $this->item;
    }

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }
}
