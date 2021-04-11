<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\RenameListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\Rename;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RenameController extends AbstractController
{
    #[Route('/api/v1/list', methods: ['PUT'])]
    public function __invoke(Rename $argument, Person $initiator): Response
    {
        $command = new RenameListCommand($argument->list(), $initiator->id(), $argument->name());

        return $this->responseBuilder->build($this->execute($command));
    }
}
