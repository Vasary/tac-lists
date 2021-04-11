<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Command\UpdateCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Template\Argument\Update;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UpdateController extends AbstractController
{
    #[Route('/api/v1/template', methods: ['PUT'])]
    public function __invoke(Update $argument, Person $person): Response
    {
        $command = new UpdateCommand(
            $argument->id(),
            $argument->name(),
            $argument->icon(),
            $person->id(),
            $argument->category(),
            $argument->images()
        );

        return $this->responseBuilder->build($this->execute($command));
    }
}
