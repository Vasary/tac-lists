<?php

declare(strict_types=1);

namespace App\Application\Category\Creator;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use Symfony\Component\String\UnicodeString;

final class CategoryCreator
{
    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(UnicodeString $name, UnicodeString $color, UnicodeString $region): Category
    {
        return $this->repository->create($name, $color, $region);
    }
}
