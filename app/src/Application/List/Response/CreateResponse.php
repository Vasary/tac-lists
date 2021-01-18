<?php

declare(strict_types=1);

namespace App\Application\List\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;

final class CreateResponse extends AbstractResponse
{
    public function __construct(
        public UnicodeString $id,
        public UnicodeString $name,
        public DateTimeImmutable $created,
        public DateTimeImmutable $updated
    ) {}
}
