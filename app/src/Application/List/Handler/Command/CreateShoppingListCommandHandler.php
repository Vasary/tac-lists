<?php

declare(strict_types=1);

namespace App\Application\List\Handler\Command;

use App\Application\List\Command\CreateShoppingListCommand;
use App\Application\List\Creator\ShoppingListCreator;
use App\Application\List\Response\CreateResponse;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use function Symfony\Component\String\u;

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

        return
            new CreateResponse(
                u($list->id()->__toString()),
                $list->name(),
                $list->created(),
                $list->updated()
            )
        ;
    }
}
