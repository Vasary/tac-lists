<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item;

use App\Application\Item\Command\UpdateCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Item\Argument\Update;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class UpdateController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/item', methods: ['PUT'])]
    public function __invoke(Update $argument, Person $initiator): Response
    {
        $command =
            new UpdateCommand(
                $argument->id(),
                $argument->template(),
                $argument->list(),
                $argument->unit(),
                $argument->order(),
                $argument->value(),
                $argument->points(),
                $argument->images(),
                $initiator->id()
            )
        ;

        return $this->responseBuilder->build($this->handle($command));
    }
}
