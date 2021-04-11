<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Unit;

use App\Application\Unit\Query\UnitsQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AllController extends AbstractController
{
    #[Route('/api/v1/units', methods: ['GET'])]
    public function __invoke(Person $person): Response
    {
        $query = new UnitsQuery($person->id());

        return $this->responseBuilder->build($this->execute($query));
    }
}
