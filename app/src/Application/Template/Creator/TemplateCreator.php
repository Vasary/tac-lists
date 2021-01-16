<?php

declare(strict_types=1);

namespace App\Application\Template\Creator;

use App\Domain\Entity\Template;
use App\Domain\Exception\CategoryNotFoundException;
use App\Domain\Exception\PersonNotFoundException;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class TemplateCreator
{
    private PersonRepositoryInterface $personRepository;

    private CategoryRepositoryInterface $categoryRepository;

    private TemplateRepositoryInterface $templateRepository;

    public function __construct(
        PersonRepositoryInterface $personRepository,
        CategoryRepositoryInterface $categoryRepository,
        TemplateRepositoryInterface $templateRepository
    ) {
        $this->personRepository = $personRepository;
        $this->categoryRepository = $categoryRepository;
        $this->templateRepository = $templateRepository;
    }

    public function create(UnicodeString $name, UnicodeString $icon, UuidV4 $categoryId, UuidV4 $personId): Template
    {
        if (null === $category = $this->categoryRepository->get($categoryId)) {
            throw new CategoryNotFoundException($category->id()->__toString());
        }

        if (null === $person = $this->personRepository->get($personId)) {
            throw new PersonNotFoundException($person->id()->__toString());
        }

        return $this->templateRepository->create($name, $icon, $category, $person);
    }
}
