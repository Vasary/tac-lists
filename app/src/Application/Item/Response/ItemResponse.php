<?php

declare(strict_types=1);

namespace App\Application\Item\Response;

use DateTimeImmutable;
use Symfony\Component\Uid\UuidV4;

final class ItemResponse
{
    public function __construct(
        public UuidV4 $id,
        public UuidV4 $template,
        public UuidV4 $list,
        public UuidV4 $unit,
        public int $order,
        public int $value,
        public bool $isPurchased,
        public array $labels,
        public array $images,
        public array $points,
        public DateTimeImmutable $created,
        public DateTimeImmutable $updated,
    ) {
    }
}
