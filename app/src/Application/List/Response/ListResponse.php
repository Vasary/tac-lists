<?php

declare(strict_types=1);

namespace App\Application\List\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class ListResponse extends AbstractResponse
{
    public function __construct(
        public UuidV4 $id,
        public UnicodeString $name,
        public array $items,
        public array $members,
        public DateTimeImmutable $created,
        public DateTimeImmutable $updated
    ) {}
}