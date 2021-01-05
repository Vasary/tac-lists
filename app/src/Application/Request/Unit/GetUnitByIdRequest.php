<?php

declare(strict_types=1);

namespace App\Application\Request\Unit;

use App\Application\Request\AbstractRequest;
use Ramsey\Uuid\UuidInterface;

final class GetUnitByIdRequest extends AbstractRequest
{
    public UuidInterface $id;
}
