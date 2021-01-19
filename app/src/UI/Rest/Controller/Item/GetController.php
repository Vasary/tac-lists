<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item;

use App\Application\Item\Query\GetItemQuery;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Item\Argument\ItemId;
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

    #[Route('/api/v1/item/{id}', methods: ['GET'])]
    public function __invoke(ItemId $argument, Person $initiator): Response
    {
        $command =
            new GetItemQuery(
                $argument->id(),
                $initiator->id()
            )
        ;

        return $this->responseBuilder->build($this->handle($command));
    }
}