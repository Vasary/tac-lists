<?php

declare(strict_types=1);

namespace App\Application\Template\Provider;

use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class DataProvider
{
    public function __construct(
        private TemplateRepositoryInterface $repository,
        private PersonRepositoryInterface $personRepository
    ) {}

    public function all(UuidV4 $personId): array
    {
        return
            $this->repository->getPersonalized(
                $this->personRepository->get($personId)
            )
        ;
    }
}