<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Command\CreateCommand;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Controller\Template\Argument\Create;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/api/v1/template', name: 'template_create', methods: ['POST'])]
    public function __invoke(Create $argument): Response
    {
        $command = new CreateCommand(
            $argument->name(),
            $argument->icon(),
            $argument->author(),
            $argument->category(),
            $argument->images()
        );

        return $this->responseBuilder->build($this->handle($command));
    }
}
