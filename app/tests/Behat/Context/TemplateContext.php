<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\Uid\UuidV4;

final class TemplateContext implements Context
{
    public function __construct(
        private TemplateRepositoryInterface $templateRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private PersonRepositoryInterface $personRepository,
        private EntityManagerInterface $manager
    ) {
    }

    /**
     * @Given /^template (.*) created by (.*) in (.*) category$/
     */
    public function spawnTemplate(string $name, string $personId, string $categoryId): void
    {
        $category = $this->categoryRepository->get(UuidV4::fromString($categoryId));
        $person = $this->personRepository->get(UuidV4::fromString($personId));

        $this->templateRepository->create(u($name), u('fa-default'), $category, $person, UuidV4::v4());

        $this->manager->flush();
    }

    /**
     * @Given /^template (.*) created by (.*) in (.*) category with id (.*)$/
     */
    public function spawnTemplateWithId(string $name, string $personId, string $categoryId, string $id): void
    {
        $category = $this->categoryRepository->get(UuidV4::fromString($categoryId));
        $person = $this->personRepository->get(UuidV4::fromString($personId));
        $id = UuidV4::fromString($id);

        $this->templateRepository->create(u($name), u('fa-default'), $category, $person, $id);

        $this->manager->flush();
    }
}
