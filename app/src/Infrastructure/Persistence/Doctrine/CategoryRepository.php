<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Category\Model\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
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

    public function create(UnicodeString $name, UnicodeString $color, UnicodeString $region, UuidV4 $id): Category
    {
        $category = new Category($name, $color, $region, $id);

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

    public function regional(UnicodeString $region): \Generator
    {
        return
            $this
                ->createQueryBuilder('c')
                ->where('c.region = :region')
                ->addOrderBy('c.name', 'ASC')
                ->setParameter('region', $region)
                ->getQuery()
                ->toIterable()
            ;
    }
}
