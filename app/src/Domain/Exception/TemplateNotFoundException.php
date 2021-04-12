<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\SystemCodes;
use DomainException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\UuidV4;

final class TemplateNotFoundException extends DomainException
{
    public function __construct(UuidV4 $id)
    {
        parent::__construct(sprintf('Template %s not found', $id), SystemCodes::TEMPLATE_NOT_FOUND);
    }
}
