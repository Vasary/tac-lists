<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Application\Index\Response\IndexResponse;
use App\Domain\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IndexController extends AbstractController
{
    private ResponseBuilderInterface $responseBuilder;

    public function __construct(ResponseBuilderInterface $responseBuilder)
    {
        $this->responseBuilder = $responseBuilder;
    }

    #[Route('/', methods: ['GET', 'HEAD'])]
    public function __invoke(Request $request, string $projectDir): Response
    {
        $data = json_decode(file_get_contents($projectDir.'/composer.json'), true);

        $responseObject = new IndexResponse(
            $data['name'],
            $data['version'],
            $data['license'],
            $data['description'],
            $data['authors']
        );

        return $this->responseBuilder->build($responseObject);
    }
}
