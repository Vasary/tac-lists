<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Unit\Argument;

use Symfony\Component\Uid\UuidV4;

final class UnitId
{
    public function __construct(private UuidV4 $id)
    {
    }

    public function id(): UuidV4
    {
        return $this->id;
    }
}
