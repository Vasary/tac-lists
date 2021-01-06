<?php

declare(strict_types=1);

namespace App\Application\Unit\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\String\UnicodeString;

final class GetUnitByIdResponse extends AbstractResponse
{
    public UnicodeString $name;

    public UnicodeString $short;

    public UnicodeString $region;

    public array $values;

    public function __construct(UnicodeString $name, UnicodeString $short, UnicodeString $region, array $values)
    {
        $this->name = $name;
        $this->short = $short;
        $this->region = $region;
        $this->values = $values;
    }
}