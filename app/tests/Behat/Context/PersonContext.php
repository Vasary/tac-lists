<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Repository\PersonRepositoryInterface;
use Behat\Behat\Context\Context;
use function Symfony\Component\String\u;
use Symfony\Component\Uid\UuidV4;

final class PersonContext implements Context
{
    public function __construct(private PersonRepositoryInterface $repository)
    {
    }

    /**
     * @Given person :id in :region
     */
    public function spawnPerson(string $id, string $region): void
    {
        $this->repository->create(UuidV4::fromString($id), u($region));
    }
}
