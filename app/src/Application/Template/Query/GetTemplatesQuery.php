<?php

declare(strict_types=1);

namespace App\Application\Template\Query;

use Symfony\Component\Uid\UuidV4;

final class GetTemplatesQuery
{
    public function __construct(private UuidV4 $person)
    {
    }

    public function person(): UuidV4
    {
        return $this->person;
    }
}
