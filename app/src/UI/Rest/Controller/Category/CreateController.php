<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category;

use App\Application\Category\Command\CreateCategoryCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Category\Argument\Create;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    #[Route('/api/v1/category', methods: ['POST'])]
    public function __invoke(Create $argument, Person $person): Response
    {
        $command = new CreateCategoryCommand($argument->name(), $argument->color(), $person->id());

        return $this->responseBuilder->build($this->execute($command), Response::HTTP_CREATED);
    }
}
