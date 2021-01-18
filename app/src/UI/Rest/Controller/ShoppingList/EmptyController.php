<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList;

use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Controller\ShoppingList\Argument\Create;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class EmptyController extends AbstractController
{
    use HandleTrait;

    public function __construct(private ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/v1/list/{id}/clear', methods: ['POST'])]
    public function __invoke(Create $argument): Response
    {
        throw new \RuntimeException('Not implemented');
    }
}
