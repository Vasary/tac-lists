<?php

declare(strict_types=1);

namespace App\Application\Label\Provider;

use App\Domain\Entity\Label;
use App\Domain\Exception\LabelNotFoundException;
use App\Domain\Repository\LabelRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class LabelProvider
{
    public function __construct(private LabelRepositoryInterface $repository)
    {
    }

    public function get(UuidV4 $id): Label
    {
        if (null === $label = $this->repository->get($id)) {
            throw new LabelNotFoundException($id);
        }

        return $label;
    }
}
