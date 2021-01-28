<?php

declare(strict_types=1);

namespace App\Application\Category\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CreateCategoryResponse extends AbstractResponse
{
    public function __construct(
        public UuidV4 $id,
        public UnicodeString $name,
        public UnicodeString $color,
        public UnicodeString $region,
        public DateTimeImmutable $created,
        public DateTimeImmutable $updated
    ) {
    }
}
