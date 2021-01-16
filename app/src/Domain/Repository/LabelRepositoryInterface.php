<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Label;

interface LabelRepositoryInterface
{
    public function get(string $id): Label | null;

    public function all(): array;
}
