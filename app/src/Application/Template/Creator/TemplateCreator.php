<?php

declare(strict_types=1);

namespace App\Application\Template\Creator;

use App\Domain\Entity\Category;
use App\Domain\Entity\Person;
use App\Domain\Entity\Template;
use App\Domain\Entity\TemplateImage;
use App\Domain\Exception\CategoryNotFoundException;
use App\Domain\Exception\PermissionDeniedException;
use App\Domain\Exception\PersonNotFoundException;
use App\Domain\Exception\TemplateNotFoundException;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\TemplateImageRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;
use function Symfony\Component\String\u;

final class TemplateCreator
{
    public function __construct(
        private PersonRepositoryInterface $personRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private TemplateRepositoryInterface $templateRepository,
        private TemplateImageRepositoryInterface $imageRepository,
    ) {
    }

    public function create(
        UnicodeString $name,
        UnicodeString $icon,
        UuidV4 $categoryId,
        UuidV4 $personId,
        array $images
    ): Template {
        $category = $this->getCategory($categoryId);
        $person = $this->getPerson($personId);

        $template = $this->templateRepository->create($name, $icon, $category, $person, UuidV4::v4());

        foreach ($images as $image) {
            $template->images()->add(new TemplateImage(u($image), $template, UuidV4::v4()));
        }

        $this->templateRepository->update($template);

        return $template;
    }

    public function delete(UuidV4 $templateId, UuidV4 $personId): void
    {
        $person = $this->getPerson($personId);
        $template = $this->getTemplate($templateId);

        if ($template->author() !== $person) {
            throw new PermissionDeniedException($personId, $template->id());
        }

        $this->templateRepository->delete($template);
    }

    public function update(
        UuidV4 $templateId,
        UnicodeString $name,
        UnicodeString $icon,
        UuidV4 $categoryId,
        UuidV4 $personId,
        array $images
    ): Template {
        $category = $this->getCategory($categoryId);
        $person = $this->getPerson($personId);
        $template = $this->getTemplate($templateId);

        if ($template->author() !== $person) {
            throw new PermissionDeniedException($personId, $template->id());
        }

        $template->applyName($name);
        $template->applyIcon($icon);
        $template->applyCategory($category);

        foreach ($template->images() as $url) {
            /* @var TemplateImage $url */
            $this->imageRepository->delete($url);
        }

        foreach ($images as $url) {
            /* @var UnicodeString $url */
            $template->images()->add($this->imageRepository->create($template, $url, UuidV4::v4()));
        }

        $this->templateRepository->update($template);

        return $template;
    }

    private function getPerson(UuidV4 $id): Person
    {
        if (null === $person = $this->personRepository->get($id)) {
            throw new PersonNotFoundException($person->id());
        }

        return $person;
    }

    private function getCategory(UuidV4 $id): Category
    {
        if (null === $category = $this->categoryRepository->get($id)) {
            throw new CategoryNotFoundException($category->id());
        }

        return $category;
    }

    private function getTemplate(UuidV4 $id): Template
    {
        if (null === $template = $this->templateRepository->get($id)) {
            throw new TemplateNotFoundException($id);
        }

        return $template;
    }
}
