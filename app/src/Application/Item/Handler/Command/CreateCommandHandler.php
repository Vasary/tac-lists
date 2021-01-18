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

        $this->creator->create(
            $command->template(),
            $command->category(),
            $command->unit(),
            $command->value(),
            $images,
            $places
        );

        return new ItemResponse();
    }
}
