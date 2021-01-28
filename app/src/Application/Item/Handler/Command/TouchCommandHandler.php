<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Command;

use App\Application\Item\Command\TouchCommand;
use App\Application\Item\Creator\Creator;
use App\Application\Item\Handler\BaseHandler;
use App\Application\Item\Provider\DataProvider;
use App\Application\Item\Response\ItemResponse;
use App\Infrastructure\Trait\ObjectAccess;

final class TouchCommandHandler extends BaseHandler
{
    use ObjectAccess;

    public function __construct(private Creator $creator, private DataProvider $provider)
    {
    }

    public function __invoke(TouchCommand $command): ItemResponse
    {
        $item = $this->provider->get($command->id());

        $this->hasPermission($item->list()->members(), $command->initiator(), $item->id());
        $this->creator->setBoughtState($item);

        return $this->createResponse($item);
    }
}
