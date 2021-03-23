<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\CreateShoppingListCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\ShoppingList\Argument\Create;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/list', methods: ['POST'])]
    public function __invoke(Create $argument, Person $initiator): Response
    {
        $command = new CreateShoppingListCommand(
            $argument->name(),
            array_merge($argument->members(), [$initiator->id()])
        );

        return $this->responseBuilder->build($this->handle($command));
    }
}
