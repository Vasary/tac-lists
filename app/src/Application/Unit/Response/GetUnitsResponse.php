<?php

declare(strict_types=1);

namespace App\Application\Unit\Response;

use App\Domain\Response\AbstractResponse;

final class GetUnitsResponse extends AbstractResponse
{
    public array $units;

    public function __construct(array $units)
    {
        $this->units = $units;
    }
}
