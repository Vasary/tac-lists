<?php

namespace App\Domain\Label\Repository;

use App\Domain\Label\Model\Label;
use Symfony\Component\Uid\UuidV4;

interface LabelRepositoryInterface
{
    public function get(UuidV4 $id): ?Label;
    public function all(): array;
}
