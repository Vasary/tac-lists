<?php

declare(strict_types=1);

namespace App\Application\Template\Handler\Command;

use App\Application\Template\Command\DeleteCommand;
use App\Application\Template\Creator\TemplateCreator;
use App\Application\Template\Response\DeleteTemplateResponse;
use App\Domain\Handler\AbstractCommandHandler;
use App\Domain\SystemCodes;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class DeleteTemplateHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    public function __construct(private TemplateCreator $creator)
    {
    }

    public function __invoke(DeleteCommand $command): DeleteTemplateResponse
    {
        $this->creator->delete($command->id(), $command->person());

        return new DeleteTemplateResponse($command->id(), SystemCodes::SUCCESS);
    }
}
