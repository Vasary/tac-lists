<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category;

use App\Application\Category\Query\GetCategories;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AllController extends AbstractController
{
    #[Route('/api/v1/categories', methods: ['GET'])]
    public function __invoke(Request $request, Person $person): Response
    {
        return $this->responseBuilder->build($this->execute(new GetCategories($person->id())));
    }
}
