<?php

namespace App\Domain\Template\Repository;

use App\Domain\Category\Model\Category;
use App\Domain\Person\Model\Person;
use App\Domain\Template\Model\Template;
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
