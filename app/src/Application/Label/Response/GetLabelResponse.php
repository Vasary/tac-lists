<?php

declare(strict_types=1);

namespace App\Application\Label\Response;

use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class GetLabelResponse
{
    public function __construct(
        public UuidV4 $id,
        public DateTimeImmutable $created,
        public DateTimeImmutable $updated,
        public UnicodeString $text
    ) {
    }
}
