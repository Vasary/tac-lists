<?php

declare(strict_types=1);

namespace App\Application\Item\Handler;

use App\Application\Item\Response\ItemResponse;
use App\Domain\GeoPoint\Model\GeoPoint;
use App\Domain\Item\Model\Item;
use App\Domain\Item\Model\ItemImage;
use App\Domain\Label\Model\Label;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

abstract class BaseHandler implements MessageHandlerInterface
{
    protected function createResponse(Item $item): ItemResponse
    {
        return
            new ItemResponse(
                $item->id(),
                $item->template()->id(),
                $item->list()->id(),
                $item->unit()->id(),
                $item->order(),
                $item->value(),
                $item->isPurchased(),
                $this->getLabels($item),
                $this->getImages($item),
                $this->getPoints($item),
                $item->created(),
                $item->updated(),
            );
    }

    private function getLabels(Item $item): array
    {
        return
            array_values(
                array_map(
                    fn (Label $label) => $label->id(),
                    $item->labels()->toArray()
                )
            );
    }

    private function getImages(Item $item): array
    {
        return
            array_values(
                array_map(
                    fn (ItemImage $image) => $image->id(),
                    $item->images()->toArray()
                )
            );
    }

    private function getPoints(Item $item): array
    {
        return
            array_values(
                array_map(
                    fn (GeoPoint $point) => $point->id(),
                    $item->points()->toArray()
                )
            );
    }
}
