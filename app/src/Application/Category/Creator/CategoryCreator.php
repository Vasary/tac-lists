<?php

declare(strict_types=1);

namespace App\Application\Category\Creator;

use App\Domain\Category\Model\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CategoryCreator
{
    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(UnicodeString $name, UnicodeString $color, UnicodeString $region): Category
    {
        return $this->repository->create($name, $color, $region, UuidV4::v4());
    }
}
