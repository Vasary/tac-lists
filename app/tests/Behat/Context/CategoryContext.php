<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Repository\CategoryRepositoryInterface;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\UuidV4;
use function Symfony\Component\String\u;

final class CategoryContext implements Context
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private EntityManagerInterface $manager
    ) {}

    /**
     * @Given /^category (.*) for ([a-z]{2})$/
     */
    public function spawnCategory(string $name, string $region): void
    {
        $this->categoryRepository->create(u($name), u('#FFFFFF'), u($region), UuidV4::v4());

        $this->manager->flush();
    }

    /**
     * @Given /^category (.*) for ([a-z]{2}) with id (.*)$/
     */
    public function spawnUnitWithId(string $name, string $region, string $id): void
    {
        $this->categoryRepository->create(u($name), u('#FFFFFF'), u($region), UuidV4::fromString($id));

        $this->manager->flush();
    }
}
