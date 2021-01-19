<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Command;

use App\Application\Item\Command\DeleteCommand;
use App\Application\Item\Creator\Creator;
use App\Application\Item\Handler\BaseHandler;
use App\Application\Item\Provider\DataProvider;
use App\Application\Item\Response\DeleteItemResponse;
use App\Domain\SystemCodes;
use App\Infrastructure\Trait\ObjectAccess;

final class DeleteCommandHandler extends BaseHandler
{
    use ObjectAccess;

    public function __construct(private Creator $creator, private DataProvider $provider) {}

    public function __invoke(DeleteCommand $command): DeleteItemResponse
    {
        $item = $this->provider->get($command->id());

        $this->hasPermission($item->list()->members(), $command->initiator(), $item->id());

        $this->creator->delete($item);

        return new DeleteItemResponse($command->id(), SystemCodes::SUCCESS);
    }
}
