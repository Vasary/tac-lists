<?php

namespace App\Application\Response\Unit;

use App\Application\Response\AbstractResponse;

final class GetUnitsResponse extends AbstractResponse
{
    public array $units;

    public function __construct(array $units)
    {
        $this->units = $units;
    }
}
