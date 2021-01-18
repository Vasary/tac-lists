<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Application\List\Command\ExcludePersonFromListCommand;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\ShoppingList\Argument\RemovePersonFromList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class ExcludePersonController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/list/person/exclude', name: 'lists_person_delete', methods: ['PUT'])]
    public function __invoke(RemovePersonFromList $argument, Person $person): Response
    {
        $command = new ExcludePersonFromListCommand($argument->list(), $argument->person(), $person->id());

        return $this->responseBuilder->build($this->handle($command));
    }
}
