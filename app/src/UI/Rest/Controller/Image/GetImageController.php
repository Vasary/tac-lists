<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Image;

use App\Application\Image\Query\GetImageByIdQuery;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

final class GetImageController extends AbstractController
{
    use HandleTrait;

    private ResponseBuilderInterface $responseBuilder;

    public function __construct(MessageBusInterface $messageBus, ResponseBuilderInterface $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/api/v1/image/{id}', name: 'images_get_image_by_id', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        $query = new GetImageByIdQuery(u($request->get('id')));

        return $this->responseBuilder->build($this->handle($query));
    }
}
