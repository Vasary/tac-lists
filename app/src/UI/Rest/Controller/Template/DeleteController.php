<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template;

use App\Application\Template\Command\DeleteCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Template\Argument\Delete;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DeleteController extends AbstractController
{
    #[Route('/api/v1/template/{id}', methods: ['DELETE'])]
    public function __invoke(Delete $argument, Person $person): Response
    {
        return $this->responseBuilder->build($this->execute(new DeleteCommand($argument->id(), $person->id())));
    }
}
