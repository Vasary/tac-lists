<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Command\UpdateCommand;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Template\Argument\Update;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class UpdateController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/template/{id}', name: 'template_update', methods: ['PUT'])]
    public function __invoke(Update $argument, Person $person): Response
    {
        $command = new UpdateCommand(
            $argument->id(),
            $argument->name(),
            $argument->icon(),
            $person->id(),
            $argument->category(),
            $argument->images()
        );

        return $this->responseBuilder->build($this->handle($command));
    }
}
