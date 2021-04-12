<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class LabelNotFoundException extends DomainException
{
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Label %s not found', $id), SystemCodes::LABEL_NOT_FOUND);
    }
}
