<?php

declare(strict_types=1);

namespace App\Application\Template\Handler;

use App\Application\Template\Command\CreateCommand;
use App\Application\Template\Creator\TemplateCreator;
use App\Application\Template\Response\CreateTemplateResponse;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Uid\UuidV4;

final class CreateTemplateHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private TemplateCreator $creator;

    public function __construct(TemplateCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCommand $command): CreateTemplateResponse
    {
        $template = $this->creator->create(
            $command->name(),
            $command->icon(),
            UuidV4::fromString($command->category()->toString()),
            UuidV4::fromString($command->author()->toString())
        );

        return
            new CreateTemplateResponse(
                $template->id(),
                $template->region(),
                $template->category()->id(),
                $template->icon(),
                $template->author()->id(),
                $template->common(),
                $template->created(),
                $template->updated()
            )
        ;
    }
}
