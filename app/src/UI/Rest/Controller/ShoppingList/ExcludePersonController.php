<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\ExcludePersonFromListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\RemovePersonFromList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ExcludePersonController extends AbstractController
{
    #[Route('/api/v1/list/person/exclude', methods: ['PUT'])]
    public function __invoke(RemovePersonFromList $argument, Person $person): Response
    {
        $command = new ExcludePersonFromListCommand($argument->list(), $argument->person(), $person->id());

        return $this->responseBuilder->build($this->execute($command));
    }
}
