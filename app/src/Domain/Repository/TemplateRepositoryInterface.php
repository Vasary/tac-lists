<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Category;
use App\Domain\Entity\Person;
use App\Domain\Entity\Template;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface TemplateRepositoryInterface
{
    public function create(UnicodeString $name, UnicodeString $icon, Category $category, Person $person, UuidV4 $id): Template;

    public function all(): array;

    public function getPersonalized(Person $person): array;

    public function get(UuidV4 $id): Template | null;

    public function delete(Template $template): void;

    public function update(Template $template): void;
}
