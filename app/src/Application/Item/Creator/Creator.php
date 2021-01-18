<?php

declare(strict_types=1);

namespace App\Application\Item\Creator;

use App\Domain\Entity\Item;
use Symfony\Component\Uid\UuidV4;

final class Creator
{
    public function create(
        UuidV4 $template,
        UuidV4 $category,
        UuidV4 $unit,
        int $value,
        array $places,
        array $points
    ): Item {

    }
}