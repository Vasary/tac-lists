<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\AddPersonToListCommand;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\ShoppingList\Argument\AddPersonToList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class AddPersonController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/list/person/add', name: 'lists_add_person', methods: ['PUT'])]
    public function __invoke(AddPersonToList $argument, Person $initiator): Response
    {
        $command = new AddPersonToListCommand(
            $argument->list(),
            $argument->person(),
            $initiator->id()
        );

        return $this->responseBuilder->build($this->handle($command));
    }
}
