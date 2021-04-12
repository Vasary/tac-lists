<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Unit\Repository\UnitRepositoryInterface;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\Uid\UuidV4;

final class UnitContext implements Context
{
    public function __construct(
        private UnitRepositoryInterface $unitRepository,
        private EntityManagerInterface $manager
    ) {
    }

    /**
     * @Given /^unit (.*) as ([a-z]{1,2}) for ([a-z]{2})$/
     */
    public function spawnUnit(string $name, string $short, string $region): void
    {
        $this->unitRepository->create(
            u($name),
            u($short),
            u($region),
            UuidV4::v4(),
            [100]
        );

        $this->manager->flush();
    }

    /**
     * @Given /^unit (.*) as ([a-z]{1,2}) for ([a-z]{2}) with id (.*)$/
     */
    public function spawnUnitWithId(string $name, string $short, string $region, string $id): void
    {
        $id = UuidV4::fromString($id);
        $defaultValues = [100, 150, 200, 500];

        $this->unitRepository->create(
            u($name),
            u($short),
            u($region),
            $id,
            $defaultValues
        );

        $this->manager->flush();
    }
}
