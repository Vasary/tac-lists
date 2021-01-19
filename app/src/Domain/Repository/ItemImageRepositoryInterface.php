<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Item;
use App\Domain\Entity\ItemImage;
use Symfony\Component\String\UnicodeString;

interface ItemImageRepositoryInterface
{
    public function create(Item $item, UnicodeString $imageURL): ItemImage;

    public function delete(ItemImage $image): void;
}
