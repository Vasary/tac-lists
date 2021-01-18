<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Command;

use App\Application\Item\Command\CreateCommand;
use App\Application\Item\Creator\Creator;
use App\Application\Item\Response\ItemResponse;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateCommandHandler  extends AbstractCommandHandler implements MessageHandlerInterface
{
    public function __construct(private Creator $creator) {}

    public function __invoke(CreateCommand $command): ItemResponse
    {
        $images = [];
        $places = [];

        $item =
            $this->creator->create(
                $command->template(),
                $command->list(),
                $command->unit(),
                $command->value(),
            )
        ;

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
