<?php

declare(strict_types=1);

namespace App\Application\Item\Creator;

use App\Domain\Exception\ListNotFoundException;
use App\Domain\Exception\TemplateNotFoundException;
use App\Domain\Exception\UnitNotFoundException;
use App\Domain\GeoPoint\Repository\PointRepositoryInterface;
use App\Domain\Item\Model\Item;
use App\Domain\Item\Repository\ItemImageRepositoryInterface;
use App\Domain\Item\Repository\ItemRepositoryInterface;
use App\Domain\ShoppingList\Repository\ShoppingListRepositoryInterface;
use App\Domain\Template\Repository\TemplateRepositoryInterface;
use App\Domain\Unit\Repository\UnitRepositoryInterface;
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
    ) {
    }

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

        return $this->itemRepository->create($template, $list, $unit, $value, UuidV4::v4());
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

    public function changeTemplate(Item $item, UuidV4 $template): void
    {
        $item->applyTemplate($this->templateRepository->get($template));

        $this->itemRepository->update($item);
    }

    public function changeList(Item $item, UuidV4 $list): void
    {
        $item->applyList($this->listRepository->get($list));

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
        $image = $this->imageRepository->create($item, $imageURL, UuidV4::v4());
        $item->images()->add($image);

        $this->itemRepository->update($item);
    }

    public function addPoint(Item $item, float $latitude, float $longitude, UnicodeString $comment): void
    {
        $point = $this->pointRepository->create($longitude, $latitude, $item, $comment, UuidV4::v4());
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
