<?php

declare(strict_types=1);

namespace App\Application\List\Handler\Command;

use App\Application\List\Command\ExcludePersonFromListCommand;
use App\Application\List\Creator\ShoppingListCreator;
use App\Application\List\Provider\Provider;
use App\Application\List\Response\ExcludePersonFromListResponse;
use App\Domain\Handler\AbstractCommandHandler;
use App\Domain\SystemCodes;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class ExcludePersonFromListCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    use HandleTrait;

    public function __construct(
        private ShoppingListCreator $creator,
        private Provider $provider,
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(ExcludePersonFromListCommand $command): ExcludePersonFromListResponse
    {
        $this->creator->excludePersonFromList($this->provider->get($command->list()), $command->person());

        return new ExcludePersonFromListResponse($command->list(), $command->person(), SystemCodes::SUCCESS);
    }
}
