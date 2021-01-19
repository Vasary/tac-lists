<?php

declare(strict_types=1);

namespace App\Application\List\Handler\Command;

use App\Application\List\Command\AddPersonToListCommand;
use App\Application\List\Creator\ShoppingListCreator;
use App\Application\List\Provider\Provider;
use App\Application\List\Response\AddPersonToListResponse;
use App\Domain\Entity\Person;
use App\Domain\Exception\AlreadyExistsException;
use App\Domain\Handler\AbstractCommandHandler;
use App\Domain\SystemCodes;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class AddPersonToListCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    use HandleTrait;

    public function __construct(
        private ShoppingListCreator $creator,
        private Provider $provider,
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(AddPersonToListCommand $command): AddPersonToListResponse
    {
        $list = $this->provider->get($command->list());

        $list->members()->forAll(
            function (int $_, Person $person) use ($command, $list) {
                if ($person->id()->toBinary() === $command->person()->toBinary()) {
                    throw new AlreadyExistsException($command->person(), $list->id());
                }
            }
        );

        $this->creator->addToList($list, $command->person());

        return new AddPersonToListResponse($command->list(), $command->person(), SystemCodes::SUCCESS);
    }
}
