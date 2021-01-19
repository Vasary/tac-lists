<?php

declare(strict_types=1);

namespace App\Application\Point\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PointResponse extends AbstractResponse
{
    public function __construct(
        public UuidV4 $id,
        public float $latitude,
        public float $longitude,
        public null | UnicodeString $comment
    ) {}
}