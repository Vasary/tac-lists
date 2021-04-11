<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Label;

use App\Application\Label\Query\GetLabelQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Label\Argument\LabelId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/label/{id}', methods: ['GET'])]
    public function __invoke(LabelId $argument, Person $person): Response
    {
        return $this->responseBuilder->build($this->execute(new GetLabelQuery($argument->id(), $person->id())));
    }
}
