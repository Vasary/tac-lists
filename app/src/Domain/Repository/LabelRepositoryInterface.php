<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Label;
use Symfony\Component\Uid\UuidV4;

interface LabelRepositoryInterface
{
    public function get(UuidV4 $id): Label | null;

    public function all(): array;
}
