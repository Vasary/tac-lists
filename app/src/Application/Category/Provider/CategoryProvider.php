<?php

declare(strict_types=1);

namespace App\Application\Category\Provider;

use App\Domain\Entity\Category;
use App\Domain\Exception\CategoryNotFoundException;
use App\Domain\Repository\CategoryRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CategoryProvider
{
    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(UnicodeString $id): Category
    {
        if (null === $category = $this->repository->get(UuidV4::fromString($id->toString()))) {
            throw new CategoryNotFoundException($id->toString());
        }

        return $category;
    }

    public function all(): array
    {
        return $this->repository->all();
    }
}
