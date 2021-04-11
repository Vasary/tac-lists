<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Person;

use App\Application\Person\Command\CreatePersonCommand;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Person\Argument\Create;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    #[Route('/api/v1/person', methods: ['POST'])]
    public function __invoke(Create $argument): Response
    {
        return
            $this
                ->responseBuilder
                    ->build(
                        $this->execute(new CreatePersonCommand($argument->id(), $argument->region())),
                        Response::HTTP_CREATED
                    )
            ;
    }
}
