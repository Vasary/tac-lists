<?php

namespace App\Domain\Repository;

use App\Domain\Entity\ItemImage;

interface ImageRepositoryInterface
{
    public function get(string $id): ItemImage | null;

    public function all(): array;
}
