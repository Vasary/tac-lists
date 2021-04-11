<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category;

use App\Application\Category\Query\GetCategory;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Category\Argument\CategoryId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/category/{id}', methods: ['GET'])]
    public function __invoke(CategoryId $argument): Response
    {
        return $this->responseBuilder->build($this->execute(new GetCategory($argument->id())));
    }
}
