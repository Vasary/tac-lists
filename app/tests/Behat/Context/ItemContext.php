<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Item\Repository\ItemRepositoryInterface;
use App\Domain\ShoppingList\Repository\ShoppingListRepositoryInterface;
use App\Domain\Template\Repository\TemplateRepositoryInterface;
use App\Domain\Unit\Repository\UnitRepositoryInterface;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\UuidV4;

final class ItemContext implements Context
{
    public function __construct(
        private UnitRepositoryInterface $unitRepository,
        private EntityManagerInterface $manager,
        private ItemRepositoryInterface $itemRepository,
        private TemplateRepositoryInterface $templateRepository,
        private ShoppingListRepositoryInterface $listRepository
    ) {
    }

    /**
     * @Given there is a item:
     */
    public function spawnItem(TableNode $table): void
    {
        $result = [];

        foreach ($table->getRows() as $row) {
            $result[$row[0]] = $row[1];
        }

        $id = UuidV4::fromString($result['id']);
        $template = UuidV4::fromString($result['template']);
        $unit = UuidV4::fromString($result['unit']);
        $list = UuidV4::fromString($result['list']);
        $value = (int) $result['value'];

        $this->itemRepository->create(
            $this->templateRepository->get($template),
            $this->listRepository->get($list),
            $this->unitRepository->get($unit),
            $value,
            $id
        );

        $this->manager->flush();
    }
}
