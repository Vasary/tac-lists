<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item;

use App\Application\Item\Command\TouchCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Item\Argument\ItemId;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class TouchController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/item/touch', methods: ['PUT'])]
    public function __invoke(ItemId $argument, Person $initiator): Response
    {
        $command = new TouchCommand($argument->id(), $initiator->id());

        return $this->responseBuilder->build($this->handle($command));
    }
}
