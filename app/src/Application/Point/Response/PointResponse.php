<?php

declare(strict_types=1);

namespace App\Application\Point\Response;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PointResponse
{
    public function __construct(
        public UuidV4 $id,
        public float $latitude,
        public float $longitude,
        public null | UnicodeString $comment
    ) {
    }
}
