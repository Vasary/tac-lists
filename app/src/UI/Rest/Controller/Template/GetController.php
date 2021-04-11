<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Query\GetTemplateQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Template\Argument\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/template/{id}', methods: ['GET'])]
    public function __invoke(Template $template, Person $person): Response
    {
        return $this->responseBuilder->build($this->execute(new GetTemplateQuery($template->id(), $person->id())));
    }
}
