<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\PurgeListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\ListId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PurgeController extends AbstractController
{
    #[Route('/api/v1/list/{id}/clear/all', methods: ['PUT'])]
    public function __invoke(ListId $list, Person $initiator): Response
    {
        return
            $this
                ->responseBuilder
                    ->build($this->execute(new PurgeListCommand($list->id(), $initiator->id())))
        ;
    }
}
