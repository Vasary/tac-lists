<?php

declare(strict_types=1);

namespace App\Application\List\Query;

use Symfony\Component\Uid\UuidV4;

final class GetListQuery
{
    public function __construct(
        private UuidV4 $list,
        private UuidV4 $person
    ) {
    }

    public function list(): UuidV4
    {
        return $this->list;
    }

    public function person(): UuidV4
    {
        return $this->person;
    }
}
