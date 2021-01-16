<?php

namespace App\Domain\Exception;

use App\Domain\ErrorCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;

final class LabelNotFoundException extends DomainException
{
    #[Pure]
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Label %s not found', $id), ErrorCodes::LABEL_NOT_FOUND);
    }
}
