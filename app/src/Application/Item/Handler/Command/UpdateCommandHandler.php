<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Command;

use App\Application\Item\Command\UpdateCommand;
use App\Application\Item\Creator\Creator;
use App\Application\Item\Handler\BaseHandler;
use App\Application\Item\Provider\DataProvider;
use App\Application\Item\Response\ItemResponse;
use App\Infrastructure\Trait\ObjectAccess;
use function Symfony\Component\String\u;

final class UpdateCommandHandler extends BaseHandler
{
    use ObjectAccess;

    public function __construct(private Creator $creator, private DataProvider $provider)
    {
    }

    public function __invoke(UpdateCommand $command): ItemResponse
    {
        $item = $this->provider->get($command->id());

        $this->hasPermission($item->list()->members(), $command->initiator(), $item->id());

        if ($command->value() !== $item->value()) {
            $this->creator->changeValue($item, $command->value());
        }

        if ($command->order() !== $item->order()) {
            $this->creator->changeOrder($item, $command->order());
        }

        if ($command->unit()->toBinary() !== $item->unit()->id()->toBinary()) {
            $this->creator->changeUnit($item, $command->unit());
        }

        $this->creator->deletePoints($item);
        foreach ($command->points() as $point) {
            $this->creator->addPoint($item, $point['longitude'], $point['latitude'], u($point['comment']), );
        }

        $this->creator->deleteImages($item);
        foreach ($command->images() as $image) {
            $this->creator->addImage($item, u($image));
        }

        return $this->createResponse($item);
    }
}
