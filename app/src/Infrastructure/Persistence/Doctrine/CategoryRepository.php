<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);

        $this->manager = $registry;
    }

    public function create(UnicodeString $name, UnicodeString $color, UnicodeString $region): Category
    {
        $category = new Category($name, $color, $region);

        $this->manager->getManager()->persist($category);
        $this->manager->getManager()->flush();

        return $category;
    }

    public function get(UuidV4 $id): Category | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }
}
