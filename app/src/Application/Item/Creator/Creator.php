<?php

declare(strict_types=1);

namespace App\Application\Item\Creator;

use App\Domain\Entity\Item;
use App\Domain\Exception\ListNotFoundException;
use App\Domain\Exception\TemplateNotFoundException;
use App\Domain\Exception\UnitNotFoundException;
use App\Domain\Repository\ItemImageRepositoryInterface;
use App\Domain\Repository\ItemRepositoryInterface;
use App\Domain\Repository\PointRepositoryInterface;
use App\Domain\Repository\ShoppingListRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use App\Domain\Repository\UnitRepositoryInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class Creator
{
    public function __construct(
        private TemplateRepositoryInterface $templateRepository,
        private ShoppingListRepositoryInterface $listRepository,
        private UnitRepositoryInterface $unitRepository,
        private ItemRepositoryInterface $itemRepository,
        private PointRepositoryInterface $pointRepository,
        private ItemImageRepositoryInterface $imageRepository,
    ) {}

    public function create(
        UuidV4 $templateId,
        UuidV4 $listId,
        UuidV4 $unitId,
        int $value
    ): Item {
        if (null === $template = $this->templateRepository->get($templateId)) {
            throw new TemplateNotFoundException($templateId);
        }

        if (null === $list = $this->listRepository->get($listId)) {
            throw new ListNotFoundException($listId);
        }

        if (null === $unit = $this->unitRepository->get($unitId)) {
            throw new UnitNotFoundException($unitId);
        }

        return $this->itemRepository->create($template, $list, $unit, $value);
    }

    public function changeUnit(Item $item, UuidV4 $unitId): void
    {
        if (null === $unit = $this->unitRepository->get($unitId)) {
            throw new UnitNotFoundException($unitId);
        }

        $item->applyUnit($unit);

        $this->itemRepository->update($item);
    }

    public function changeOrder(Item $item, int $order): void
    {
        $item->applyOrder($order);

        $this->itemRepository->update($item);
    }

    public function changeValue(Item $item, int $value): void
    {
        $item->applyValue($value);

        $this->itemRepository->update($item);
    }

    public function setBoughtState(Item $item): void
    {
        $item->isPurchased() ? $item->applyNotBought() : $item->applyBought();

        $this->itemRepository->update($item);
    }

    public function delete(Item $item): void
    {
        $this->itemRepository->delete($item);
    }

    public function addImage(Item $item, UnicodeString $imageURL): void
    {
        $image = $this->imageRepository->create($item, $imageURL);
        $item->images()->add($image);

        $this->itemRepository->update($item);
    }

    public function addPoint(Item $item, float $latitude, float $longitude, UnicodeString $comment): void
    {
        $point = $this->pointRepository->create($longitude, $latitude, $item, $comment);
        $item->points()->add($point);

        $this->itemRepository->update($item);
    }

    public function deletePoints(Item $item): void
    {
        foreach ($item->points() as $index => $point) {
            $this->pointRepository->delete($point);
            $item->points()->remove($index);
        }
    }

    public function deleteImages(Item $item): void
    {
        foreach ($item->images() as $index => $image) {
            $this->imageRepository->delete($image);
            $item->images()->remove($index);
        }
    }
}
