<?php

namespace App\Domain\GeoPoint\Repository;

use App\Domain\GeoPoint\Model\GeoPoint;
use App\Domain\Item\Model\Item;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface PointRepositoryInterface
{
    public function get(UuidV4 $id): GeoPoint | null;
    public function create(float $longitude, float $latitude, Item $item, UnicodeString $comment, UuidV4 $id): GeoPoint;
    public function delete(GeoPoint $point): void;
}
