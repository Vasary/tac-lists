<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class PersonRepository extends ServiceEntityRepository implements PersonRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);

        $this->manager = $registry;
    }

    public function create(UuidV4 $id, UnicodeString $region): Person
    {
        $person = new Person($id, $region);

        $this->manager->getManager()->persist($person);
        $this->manager->getManager()->flush();

        return $person;
    }

    public function get(UuidV4 $id): Person | null
    {
        return $this->findOneBy(['id' => $id]);
    }
}
