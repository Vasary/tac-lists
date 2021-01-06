<?php

declare(strict_types=1);

namespace App\Application\Unit\Request;

use App\Domain\Request\AbstractRequest;

final class GetUnitByIdRequest extends AbstractRequest
{
    public string $id;
}
