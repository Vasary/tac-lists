<?php

declare(strict_types=1);

namespace App\Application\Person\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PersonResponse extends AbstractResponse
{
    public UuidV4 $id;

    public UnicodeString $region;

    public function __construct(UuidV4 $id, UnicodeString $region)
    {
        $this->id = $id;
        $this->region = $region;
    }
}