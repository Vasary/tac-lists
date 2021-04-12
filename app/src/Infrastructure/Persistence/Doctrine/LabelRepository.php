<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Label\Model\Label;
use App\Domain\Label\Repository\LabelRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\UuidV4;

final class LabelRepository extends ServiceEntityRepository implements LabelRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Label::class);
    }

    public function get(UuidV4 $id): Label | null
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function all(): array
    {
        return $this->findBy([], ['created' => 'DESC']);
    }
}
