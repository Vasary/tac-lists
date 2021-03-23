<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Repository\ItemRepositoryInterface;
use App\Domain\Repository\PointRepositoryInterface;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\UuidV4;
use function Symfony\Component\String\u;

final class PointContext implements Context
{
    public function __construct(
        private ItemRepositoryInterface $itemRepository,
        private PointRepositoryInterface $pointRepository,
        private EntityManagerInterface $manager
    ) {}

    /**
     * @Given there is a point:
     */
    public function spawnPoint(TableNode $table): void
    {
        $result = [];

        foreach ($table->getRows() as $row) {
            $result[$row[0]] = $row[1];
        }

        $id         = UuidV4::fromString($result['id']);
        $item       = UuidV4::fromString($result['item']);
        $longitude  = (float) $result['longitude'];
        $latitude   = (float) $result['latitude'];
        $comment    = u($result['comment']);

        $item = $this->itemRepository->get($item);
        $this->pointRepository->create($longitude, $latitude, $item, $comment, $id);

        $this->manager->flush();
    }
}
