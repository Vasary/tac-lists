<?php

declare(strict_types=1);

namespace App\Application\Unit\Response;

use App\Domain\Response\AbstractResponse;

final class UnitsResponse extends AbstractResponse
{
    public function __construct(public array $units) {}
}
