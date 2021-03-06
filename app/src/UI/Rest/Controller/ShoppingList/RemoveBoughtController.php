<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\RemoveBoughtItemsListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\ShoppingList\Argument\ListId;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class RemoveBoughtController extends AbstractController
{
    #[Route('/api/v1/list/{id}/clear/bought', methods: ['PUT'])]
    public function __invoke(Person $initiator, ListId $list): Response
    {
        return
            $this
                ->responseBuilder
                    ->build($this->execute(new RemoveBoughtItemsListCommand($list->id(), $initiator->id())))
        ;
    }
}
