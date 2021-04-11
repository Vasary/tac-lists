<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\AddPersonToListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\AddPersonToList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AddPersonController extends AbstractController
{
    #[Route('/api/v1/list/person/add', methods: ['PUT'])]
    public function __invoke(AddPersonToList $argument, Person $initiator): Response
    {
        $command = new AddPersonToListCommand(
            $argument->list(),
            $argument->person(),
            $initiator->id()
        );

        return $this->responseBuilder->build($this->execute($command));
    }
}
