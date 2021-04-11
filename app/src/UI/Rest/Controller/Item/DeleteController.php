<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item;

use App\Application\Item\Command\DeleteCommand;
use App\UI\Rest\Argument\Person;
use App\UI\Rest\Controller\AbstractController;
use App\UI\Rest\Controller\Item\Argument\ItemId;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DeleteController extends AbstractController
{
    #[Route('/api/v1/item/{id}', methods: ['DELETE'])]
    public function __invoke(ItemId $argument, Person $initiator): Response
    {
        $command = new DeleteCommand($argument->id(), $initiator->id());

        return $this->responseBuilder->build($this->execute($command));
    }
}
