<?php

declare(strict_types=1);

namespace App\Application\Person\Handler\Command;

use App\Application\Person\Command\AddToListCommand;
use App\Application\Person\Provider\DataProvider;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Uid\UuidV4;

final class AddPersonToListHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private DataProvider $provider;

    public function __construct(DataProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(AddToListCommand $command): void
    {
        $list = $command->list();
        $person = $this->provider->get(UuidV4::fromString($command->personId()->toString()));

        $person->addToList($command->list());
        $list->addPerson($person);
    }
}