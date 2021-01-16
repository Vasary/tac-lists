<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Category;
use App\Domain\Entity\Person;
use App\Domain\Entity\Template;
use App\Domain\Entity\Unit;
use App\Domain\Repository\TemplateRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;

final class TemplateRepository extends ServiceEntityRepository implements TemplateRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unit::class);

        $this->manager = $registry;
    }

    public function create(UnicodeString $name, UnicodeString $icon, Category $category, Person $person): Template
    {
        $template = new Template($name, $icon, $category, $person, $person->region());

        $this->manager->getManager()->persist($template);
        $this->manager->getManager()->flush();

        return $template;
    }
}
