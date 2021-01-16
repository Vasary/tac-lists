<?php

declare(strict_types=1);

namespace App\Application\Label\Provider;

use App\Domain\Entity\Label;
use App\Domain\Exception\LabelNotFoundException;
use App\Domain\Repository\LabelRepositoryInterface;

final class LabelProvider
{
    private LabelRepositoryInterface $repository;

    public function __construct(LabelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $id): Label
    {
        if (null === $label = $this->repository->get($id)) {
            throw new LabelNotFoundException($id);
        }

        return $label;
    }

    public function getAll(): array
    {
        return $this->repository->all();
    }
}
