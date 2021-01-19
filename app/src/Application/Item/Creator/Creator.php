<?php

declare(strict_types=1);

namespace App\Application\Item\Creator;

use App\Domain\Entity\Item;
use App\Domain\Exception\ListNotFoundException;
use App\Domain\Exception\TemplateNotFoundException;
use App\Domain\Exception\UnitNotFoundException;
use App\Domain\Repository\ItemRepositoryInterface;
use App\Domain\Repository\ShoppingListRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use App\Domain\Repository\UnitRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class Creator
{
    public function __construct(
        private TemplateRepositoryInterface $templateRepository,
        private ShoppingListRepositoryInterface $listRepository,
        private UnitRepositoryInterface $unitRepository,
        private ItemRepositoryInterface $itemRepository,
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

    public function setBoughtState(Item $item): void
    {
        $item->isPurchased() ? $item->applyNotBought() : $item->applyBought();

        $this->itemRepository->update($item);
    }

    public function addImage(): void {}
    public function addPoint(): void {}
    public function addLabel(): void {}
}