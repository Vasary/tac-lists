<?php

declare(strict_types=1);

namespace App\Application\Person\Handler\Command;

use App\Application\Person\Command\CreatePersonCommand;
use App\Application\Person\Creator\PersonCreator;
use App\Application\Person\Response\PersonResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Uid\UuidV4;

final class CreatePersonHandler implements MessageHandlerInterface
{
    private PersonCreator $creator;

    public function __construct(PersonCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreatePersonCommand $command): PersonResponse
    {
        $person = $this->creator->create(UuidV4::fromString($command->personId()->toString()), $command->region());

        return new PersonResponse($person->id(), $person->region(), []);
    }
}
