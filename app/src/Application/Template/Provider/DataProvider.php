<?php

declare(strict_types=1);

namespace App\Application\Template\Provider;

use App\Domain\Repository\TemplateRepositoryInterface;

final class DataProvider
{
    private TemplateRepositoryInterface $repository;

    public function __construct(TemplateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all(): array
    {
        return $this->repository->all();
    }
}