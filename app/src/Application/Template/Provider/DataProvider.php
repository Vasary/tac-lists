<?php

declare(strict_types=1);

namespace App\Application\Template\Provider;

use App\Domain\Entity\Template;
use App\Domain\Exception\PermissionDeniedException;
use App\Domain\Exception\PersonNotFoundException;
use App\Domain\Exception\TemplateNotFoundException;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class DataProvider
{
    public function __construct(
        private TemplateRepositoryInterface $repository,
        private PersonRepositoryInterface $personRepository
    ) {
    }

    public function get(UuidV4 $id, UuidV4 $personId): Template
    {
        if (null === $person = $this->personRepository->get($personId)) {
            throw new PersonNotFoundException($personId);
        }

        if (null === $template = $this->repository->get($id)) {
            throw new TemplateNotFoundException($id);
        }

        if ($template->author()->id() === $person->id()) {
            return $template;
        }

        if (true === $template->common()) {
            return $template;
        }

        throw new PermissionDeniedException($person->id(), $template->id());
    }

    public function all(UuidV4 $personId): array
    {
        return
            $this->repository->getPersonalized(
                $this->personRepository->get($personId)
            )
        ;
    }
}
