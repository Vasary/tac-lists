<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Category;
use App\Domain\Entity\Person;
use App\Domain\Entity\Template;
use Symfony\Component\String\UnicodeString;

interface TemplateRepositoryInterface
{
    public function create(UnicodeString $name, UnicodeString $icon, Category $category, Person $person): Template;

    public function all(): array;
}
