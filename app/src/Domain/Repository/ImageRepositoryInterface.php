<?php

namespace App\Domain\Repository;

use App\Domain\Entity\ItemImage;

interface ImageRepositoryInterface
{
    public const TYPE_IMAGE = 1;
    public const TYPE_TEMPLATE = 2;

    public function get(string $id): ItemImage | null;

    public function all(): array;
}
