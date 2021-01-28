<?php

declare(strict_types=1);

namespace App\Application\Person\Query;

use App\Domain\Query\AbstractQuery;
use Symfony\Component\Uid\UuidV4;

final class GetQuery extends AbstractQuery
{
    public function __construct(private UuidV4 $person)
    {
    }

    public function person(): UuidV4
    {
        return $this->person;
    }
}
