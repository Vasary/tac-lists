<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Label;

use App\Application\Label\Query\GetLabelsQuery;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class GetLabelsController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/labels', name: 'labels_get_labels', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->responseBuilder->build($this->handle(new GetLabelsQuery()));
    }
}
