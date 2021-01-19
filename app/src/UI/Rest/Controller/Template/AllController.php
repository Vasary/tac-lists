<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Query\GetTemplatesQuery;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Argument\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class AllController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/templates', methods: ['GET'])]
    public function __invoke(Person $person): Response
    {
        return $this->responseBuilder->build($this->handle(new GetTemplatesQuery($person->id())));
    }
}