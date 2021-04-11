<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Person;

use App\Application\Person\Query\GetQuery;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetController extends AbstractController
{
    #[Route('/api/v1/person', methods: ['GET'])]
    public function __invoke(Person $argument): Response
    {
        return
            $this
                ->responseBuilder
                    ->build(
                        $this->execute(new GetQuery($argument->id()))
                    )
            ;
    }
}
