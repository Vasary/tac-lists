<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Image;

use App\Application\Image\Query\GetImageQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Label\Argument\LabelId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/image/{id}', methods: ['GET'])]
    public function __invoke(LabelId $argument, Person $person): Response
    {
        return $this->responseBuilder->build($this->execute(new GetImageQuery($argument->id(), $person->id())));
    }
}
