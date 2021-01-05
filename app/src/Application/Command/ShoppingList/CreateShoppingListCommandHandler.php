<?php

declare(strict_types=1);

namespace App\Application\Command\ShoppingList;

use App\Application\Command\AbstractCommandHandler;
use App\Application\Request\ShoppingList\CreateShoppingListRequest;
use App\Application\Response\ShoppingList\CreateShoppingListResponse;
use JMS\Serializer\ArrayTransformerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\String\UnicodeString;

final class CreateShoppingListCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private ArrayTransformerInterface $serializer;

    private ShoppingListCreator $creator;

    public function __construct(ArrayTransformerInterface $serializer, ShoppingListCreator $creator)
    {
        $this->serializer = $serializer;
        $this->creator = $creator;
    }

    public function __invoke(CreateShoppingListCommand $command): CreateShoppingListResponse
    {
        /** @var CreateShoppingListRequest $request */
        $request = $this->serializer->fromArray($command->request, CreateShoppingListRequest::class);

        $response = $this->creator->create(new UnicodeString($request->name));

        return new CreateShoppingListResponse();
    }
}
