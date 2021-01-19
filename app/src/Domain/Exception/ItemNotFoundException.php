<?php

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class ItemNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(UuidV4 $item)
    {
        parent::__construct(sprintf('Item %s not found', $item), SystemCodes::ITEM_NOT_FOUND);
    }
}
