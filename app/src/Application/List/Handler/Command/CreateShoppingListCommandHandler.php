<?php

declare(strict_types=1);

namespace App\Application\List\Handler\Command;

use App\Application\List\Command\CreateShoppingListCommand;
use App\Application\List\Creator\ShoppingListCreator;
use App\Application\List\Response\CreateResponse;
use App\Domain\Entity\Person;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreateShoppingListCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    use HandleTrait;

    private ShoppingListCreator $creator;

    public function __construct(ShoppingListCreator $creator, MessageBusInterface $messageBus)
    {
        $this->creator = $creator;
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateShoppingListCommand $command): CreateResponse
    {
        $list = $this->creator->create($command->name());

        foreach ($command->membersIds() as $membersId) {
            $this->creator->addToList($list, $membersId);
        }

        return
            new CreateResponse(
                $list->id(),
                $list->name(),
                [],
                array_map(fn (Person $person) => $person->id(), $list->members()->toArray()),
                $list->created(),
                $list->updated()
            )
        ;
    }
}
