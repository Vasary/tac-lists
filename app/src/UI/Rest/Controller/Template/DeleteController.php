<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Command\DeleteCommand;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Template\Argument\Delete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class DeleteController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/template/{id}', name: 'template_delete', methods: ['DELETE'])]
    public function __invoke(Delete $argument, Person $person): Response
    {
        return $this->responseBuilder->build($this->handle(new DeleteCommand($argument->id(), $person->id())));
    }
}
