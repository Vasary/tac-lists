<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Point;

use App\Application\Point\Query\GetPointQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Label\Argument\LabelId;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/point/{id}', methods: ['GET'])]
    public function __invoke(LabelId $argument, Person $person): Response
    {
        return $this->responseBuilder->build($this->handle(new GetPointQuery($argument->id(), $person->id())));
    }
}
