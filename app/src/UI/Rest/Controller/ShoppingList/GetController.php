<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Query\GetListQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\ListId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/list/{id}', methods: ['GET'])]
    public function __invoke(ListId $argument, Person $initiator): Response
    {
        return $this->responseBuilder->build($this->execute(new GetListQuery($argument->id(), $initiator->id())));
    }
}
