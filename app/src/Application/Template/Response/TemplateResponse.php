<?php

declare(strict_types=1);

namespace App\Application\Template\Response;

use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class TemplateResponse
{
    public function __construct(
        public UuidV4 $id,
        public UnicodeString $name,
        public UnicodeString $region,
        public UuidV4 $category,
        public UnicodeString $icon,
        public UuidV4 $author,
        public bool $common,
        public array $images,
        public DateTimeImmutable $created,
        public DateTimeImmutable $updated
    ) {
    }
}
