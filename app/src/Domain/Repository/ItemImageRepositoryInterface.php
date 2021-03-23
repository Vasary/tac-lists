<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Item;
use App\Domain\Entity\ItemImage;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface ItemImageRepositoryInterface
{
    public function create(Item $item, UnicodeString $imageURL, UuidV4 $id): ItemImage;

    public function delete(ItemImage $image): void;

    public function get(UuidV4 $id): ItemImage;
}
