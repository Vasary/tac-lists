<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Command;

use App\Application\Item\Command\TouchCommand;
use App\Application\Item\Creator\Creator;
use App\Application\Item\Provider\DataProvider;
use App\Application\Item\Response\ItemResponse;
use App\Domain\Entity\Person;
use App\Domain\Exception\PermissionDeniedException;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class TouchCommandHandler  extends AbstractCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private Creator $creator,
        private DataProvider $provider
    ) {}

    public function __invoke(TouchCommand $command): ItemResponse
    {
        $item = $this->provider->get($command->id());

        $isInitiatorMemberOfList
            = $item->list()->members()->exists(fn(Person $person) => $person->id()->toBinary() === $command->id()->toBinary());

        if (!$isInitiatorMemberOfList) {
            throw new PermissionDeniedException($command->id(), $item->id());
        }

        $this->creator->setBoughtState($item);

        return
            new ItemResponse(
                $item->id(),
                $item->template()->id(),
                $item->list()->id(),
                $item->unit()->id(),
                $item->value(),
                [],
                [],
                [],
                $item->created(),
                $item->updated(),
            )
        ;
    }
}
