<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Label;
use App\Domain\Repository\LabelRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class LabelRepository extends ServiceEntityRepository implements LabelRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Label::class);

        $this->manager = $registry;
    }

    public function get(string $id): Label | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }
}
