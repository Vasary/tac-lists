<?php

declare(strict_types=1);

namespace App\Application\List\Handler;

use App\Application\List\Command\CreateShoppingListCommand;
use App\Application\List\Creator\ShoppingListCreator;
use App\Application\Response\ShoppingList\CreateShoppingListResponse;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateShoppingListCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private ShoppingListCreator $creator;

    public function __construct(ShoppingListCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateShoppingListCommand $command): CreateShoppingListResponse
    {
//        /** @var CreateShoppingListRequest $request */
//        $request = $this->serializer->fromArray($command->request, CreateShoppingListRequest::class);
//
//        $response = $this->creator->create(new UnicodeString($request->name));

        return new CreateShoppingListResponse();
    }
}
