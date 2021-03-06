<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Category\Model\Category;
use App\Domain\Person\Model\Person;
use App\Domain\Template\Model\Template;
use App\Domain\Template\Repository\TemplateRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class TemplateRepository extends ServiceEntityRepository implements TemplateRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Template::class);

        $this->manager = $registry;
    }

    public function create(UnicodeString $name, UnicodeString $icon, Category $category, Person $person, UuidV4 $id): Template
    {
        $template = new Template($name, $icon, $category, $person, $person->region(), $id);

        $this->manager->getManager()->persist($template);
        $this->manager->getManager()->flush();

        return $template;
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }

    public function getPersonalized(Person $person): array
    {
        $builder = $this->getEntityManager()->createQueryBuilder();

        $query = $builder
            ->select('t')
            ->from(Template::class, 't')
            ->where('t.isCommon = :common')
            ->orWhere('t.author = :author')
            ->orderBy('t.name', 'ASC')
            ->setParameter('common', true)
            ->setParameter('author', $person)
            ->getQuery()
        ;

        return $query->getResult();
    }

    public function get(UuidV4 $id): Template | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function delete(Template $template): void
    {
        $this->manager->getManager()->remove($template);
        $this->manager->getManager()->flush();
    }

    public function update(Template $template): void
    {
        $this->manager->getManager()->persist($template);
        $this->manager->getManager()->flush();
        $this->manager->getManager()->refresh($template);
    }
}
