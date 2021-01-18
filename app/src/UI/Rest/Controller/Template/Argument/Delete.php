<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template\Argument;

use Symfony\Component\Uid\UuidV4;

final class Delete
{
    private UuidV4 $id;

    public function __construct(UuidV4 $id)
    {
        $this->id = $id;
    }

    public function id(): UuidV4
    {
        return $this->id;
    }
}
