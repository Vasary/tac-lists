<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\CreateShoppingListCommand;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Controller\ShoppingList\Argument\Create;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/list', name: 'lists_create', methods: ['POST'])]
    public function __invoke(Create $argument): Response
    {
        $command = new CreateShoppingListCommand($argument->name(), $argument->members());

        return $this->responseBuilder->build($this->handle($command));
    }
}
