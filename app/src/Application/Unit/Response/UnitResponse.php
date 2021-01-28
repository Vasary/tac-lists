<?php

declare(strict_types=1);

namespace App\Application\Unit\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class UnitResponse extends AbstractResponse
{
    public function __construct(
        public UuidV4 $id,
        public UnicodeString $name,
        public UnicodeString $short,
        public UnicodeString $region,
        public array $values
    ) {
    }
}
