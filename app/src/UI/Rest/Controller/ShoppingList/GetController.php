<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Query\GetListQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\ShoppingList\Argument\ListId;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/list/{id}', methods: ['GET'])]
    public function __invoke(ListId $argument, Person $initiator): Response
    {
        $command = new GetListQuery($argument->id(), $initiator->id());

        return $this->responseBuilder->build($this->handle($command));
    }
}
