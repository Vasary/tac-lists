<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item;

use App\Application\Item\Command\CreateCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Item\Argument\Create;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateController extends AbstractController
{
    #[Route('/api/v1/item', methods: ['POST'])]
    public function __invoke(Create $argument, Person $initiator): Response
    {
        $command =
            new CreateCommand(
                $argument->template(),
                $argument->list(),
                $argument->unit(),
                $argument->value(),
                $argument->points(),
                $argument->images(),
                $initiator->id()
            )
        ;

        return $this->responseBuilder->build($this->execute($command), Response::HTTP_CREATED);
    }
}
