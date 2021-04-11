<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Query\GetTemplatesQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AllController extends AbstractController
{
    #[Route('/api/v1/templates', methods: ['GET'])]
    public function __invoke(Person $person): Response
    {
        return $this->responseBuilder->build($this->execute(new GetTemplatesQuery($person->id())));
    }
}
