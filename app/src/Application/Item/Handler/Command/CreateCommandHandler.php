<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Command;

use App\Application\Item\Command\CreateCommand;
use App\Application\Item\Creator\Creator;
use App\Application\Item\Handler\BaseHandler;
use App\Application\Item\Response\ItemResponse;
use function Symfony\Component\String\u;

final class CreateCommandHandler extends BaseHandler
{
    public function __construct(private Creator $creator)
    {
    }

    public function __invoke(CreateCommand $command): ItemResponse
    {
        $item =
            $this->creator->create(
                $command->template(),
                $command->list(),
                $command->unit(),
                $command->value(),
            )
        ;

        foreach ($command->points() as $point) {
            $this->creator->addPoint($item, $point['longitude'], $point['latitude'], u($point['comment']), );
        }

        foreach ($command->images() as $image) {
            $this->creator->addImage($item, u($image));
        }

        return $this->createResponse($item);
    }
}
