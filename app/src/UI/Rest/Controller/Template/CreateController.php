<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Command\CreateCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Template\Argument\Create;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    #[Route('/api/v1/template', methods: ['POST'])]
    public function __invoke(Create $argument, Person $person): Response
    {
        $command = new CreateCommand(
            $argument->name(),
            $argument->icon(),
            $person->id(),
            $argument->category(),
            $argument->images()
        );

        return $this->responseBuilder->build($this->execute($command), Response::HTTP_CREATED);
    }
}
