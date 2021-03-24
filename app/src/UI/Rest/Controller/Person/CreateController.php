<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Person;

use App\Application\Person\Command\CreatePersonCommand;
use App\UI\Rest\Controller\Person\Argument\Create;
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

    #[Route('/api/v1/person', methods: ['POST'])]
    public function __invoke(Create $argument): Response
    {
        return
            $this
                ->responseBuilder
                    ->build(
                        $this->handle(new CreatePersonCommand($argument->id(), $argument->region())),
                        Response::HTTP_CREATED
                    )
            ;
    }
}
