<?php

declare(strict_types=1);

namespace App\Application\Unit\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class GetUnitResponse extends AbstractResponse
{
    public UuidV4 $id;

    public UnicodeString $name;

    public UnicodeString $short;

    public UnicodeString $region;

    public array $values;

    public function __construct(UuidV4 $id, UnicodeString $name, UnicodeString $short, UnicodeString $region, array $values)
    {
        $this->id = $id;
        $this->name = $name;
        $this->short = $short;
        $this->region = $region;
        $this->values = $values;
    }
}
