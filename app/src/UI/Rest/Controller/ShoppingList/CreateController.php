<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\Command\ShoppingList\CreateShoppingListCommand;
use App\Application\Service\Builder\ResponseBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilder $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilder $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route(path: '/api/v1/shopping_list', name: 'lists_create', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $command = new CreateShoppingListCommand($request->getContent());

        return $this->responseBuilder->build($this->handle($command), $command->request);
    }
}
