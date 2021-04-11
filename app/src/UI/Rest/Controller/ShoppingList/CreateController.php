<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\CreateShoppingListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\Create;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    #[Route('/api/v1/list', methods: ['POST'])]
    public function __invoke(Create $argument, Person $initiator): Response
    {
        $command = new CreateShoppingListCommand(
            $argument->name(),
            array_merge($argument->members(), [$initiator->id()])
        );

        return $this->responseBuilder->build($this->execute($command), Response::HTTP_CREATED);
    }
}
