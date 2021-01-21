<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category;

use App\Application\Category\Query\GetCategory;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use App\UI\Rest\Controller\Category\Argument\CategoryId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

final class GetController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/category/{id}', methods: ['GET'])]
    public function __invoke(CategoryId $argument): Response
    {
        return $this->responseBuilder->build($this->handle(new GetCategory($argument->id())));
    }
}
