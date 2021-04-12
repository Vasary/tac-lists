<?php

declare(strict_types=1);

namespace App\Application\Person\Response;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PersonResponse
{
    public function __construct(public UuidV4 $id, public UnicodeString $region, public array $lists)
    {
    }
}
