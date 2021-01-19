<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Person;

use App\Application\Person\Query\GetQuery;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/person', methods: ['GET'])]
    public function __invoke(Person $argument): Response
    {
        return
            $this
                ->responseBuilder
                    ->build(
                        $this->handle(new GetQuery($argument->id()))
                    )
            ;
    }
}