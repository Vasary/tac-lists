<?php

declare(strict_types=1);

namespace App\Application\Point\Provider;

use App\Domain\Entity\GeoPoint;
use App\Domain\Exception\PointNotFoundException;
use App\Domain\Repository\PointRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class DataProvider
{
    public function __construct(private PointRepositoryInterface $repository)
    {
    }

    public function get(UuidV4 $id): GeoPoint
    {
        if (null === $point = $this->repository->get($id)) {
            throw new PointNotFoundException($id);
        }

        return $point;
    }
}
