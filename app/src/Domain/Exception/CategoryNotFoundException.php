<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use Symfony\Component\Uid\UuidV4;

final class CategoryNotFoundException extends DomainException
{
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Category %s not found', $id), SystemCodes::CATEGORY_NOT_FOUND);
    }
}
