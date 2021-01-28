<?php

declare(strict_types=1);

namespace App\Application\List\Handler\Command;

use App\Application\List\Command\RemoveBoughtItemsListCommand;
use App\Application\List\Creator\ShoppingListCreator;
use App\Application\List\Provider\Provider;
use App\Application\List\Response\ListResponse;
use App\Domain\Entity\Item;
use App\Domain\Entity\Person;
use App\Domain\Exception\PermissionDeniedException;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class RemoveBoughtListCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    use HandleTrait;

    public function __construct(
        private ShoppingListCreator $creator,
        private Provider $provider,
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(RemoveBoughtItemsListCommand $command): ListResponse
    {
        $list = $this->provider->get($command->list());

        $personIsMember =
            $list
                ->members()
                ->exists(
                    fn (int $_, Person $person) => $person->id()->toBinary() === $command->initiator()->toBinary()
                )
            ;

        if (!$personIsMember) {
            throw new PermissionDeniedException($command->initiator(), $list->id());
        }

        $bought = $list->items()->filter(fn (Item $item) => $item->isPurchased());
        foreach ($bought->toArray() as $item) {
            $this->creator->removeItem($list, $item);
        }

        return
            new ListResponse(
                $list->id(),
                $list->name(),
                array_values(array_map(fn (Item $item) => $item->id(), $list->items()->toArray())),
                array_values(array_map(fn (Person $person) => $person->id(), $list->members()->toArray())),
                $list->created(),
                $list->updated()
            )
        ;
    }
}
