<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Application\Index\Response\IndexResponse;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IndexController
{
    public function __construct(private ResponseBuilderInterface $responseBuilder)
    {
    }

    #[Route('/', methods: ['GET'])]
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
