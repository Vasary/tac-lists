<?php

declare(strict_types=1);

namespace App\Application\Item\Provider;

use App\Domain\Entity\Item;
use App\Domain\Exception\ItemNotFoundException;
use App\Domain\Repository\ItemRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class DataProvider
{
    public function __construct(private ItemRepositoryInterface $repository)
    {
    }

    public function get(UuidV4 $id): Item
    {
        if (null === $item = $this->repository->get($id)) {
            throw new ItemNotFoundException($id);
        }

        return $item;
    }
}
