<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Image;

use App\Application\Image\Query\GetImageQuery;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\Label\Argument\LabelId;
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

    #[Route('/api/v1/image/{id}', methods: ['GET'])]
    public function __invoke(LabelId $argument, Person $person): Response
    {
        return $this->responseBuilder->build($this->handle(new GetImageQuery($argument->id(), $person->id())));
    }
}
