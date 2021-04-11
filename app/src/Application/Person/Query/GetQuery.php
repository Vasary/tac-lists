<?php

declare(strict_types=1);

namespace App\Application\Person\Query;

use Symfony\Component\Uid\UuidV4;

final class GetQuery
{
    public function __construct(private UuidV4 $person)
    {
    }

    public function person(): UuidV4
    {
        return $this->person;
    }
}
