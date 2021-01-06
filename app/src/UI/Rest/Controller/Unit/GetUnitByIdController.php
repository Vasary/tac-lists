<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Unit;

use App\Application\Command\Unit\GetUnitByIdCommand;
use App\Application\Service\Builder\ResponseBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class GetUnitByIdController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilder $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilder $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route(path: '/api/v1/unit/{id}', name: 'units_get_unit_by_id', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        $command = new GetUnitByIdCommand(json_encode(['id' => $request->get('id')]));

        return $this->responseBuilder->build($this->handle($command), $command->request);
    }
}
