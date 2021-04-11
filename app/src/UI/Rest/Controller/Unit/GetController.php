<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Unit;

use App\Application\Unit\Query\UnitQuery;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Unit\Argument\UnitId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/unit/{id}', methods: ['GET'])]
    public function __invoke(UnitId $argument): Response
    {
        return $this->responseBuilder->build($this->execute(new UnitQuery($argument->id())));
    }
}
