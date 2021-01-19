<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Point\Argument;

use Symfony\Component\Uid\UuidV4;

final class PointId
{
    public function __construct(private UuidV4 $id) {}

    public function id(): UuidV4
    {
        return $this->id;
    }
}
