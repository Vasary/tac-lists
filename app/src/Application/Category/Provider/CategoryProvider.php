<?php

declare(strict_types=1);

namespace App\Application\Category\Provider;

use App\Domain\Category\Model\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Exception\CategoryNotFoundException;
use App\Domain\Person\Repository\PersonRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CategoryProvider
{
    public function __construct(
        private CategoryRepositoryInterface $repository,
        private PersonRepositoryInterface $personRepository
    ) {
    }

    public function get(UnicodeString $id): Category
    {
        $uuid = UuidV4::fromString($id->toString());

        if (null === $category = $this->repository->get($uuid)) {
            throw new CategoryNotFoundException($uuid);
        }

        return $category;
    }

    public function all(): array
    {
        return $this->repository->all();
    }

    public function regional(UuidV4 $person): \Generator
    {
        return $this->repository->regional($this->personRepository->get($person)->region());
    }
}
