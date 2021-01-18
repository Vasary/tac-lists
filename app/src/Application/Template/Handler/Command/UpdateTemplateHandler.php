<?php

declare(strict_types=1);

namespace App\Application\Template\Handler\Command;

use App\Application\Template\Command\UpdateCommand;
use App\Application\Template\Creator\TemplateCreator;
use App\Application\Template\Response\TemplateResponse;
use App\Domain\Entity\TemplateImage;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class UpdateTemplateHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    public function __construct(private TemplateCreator $creator) {}

    public function __invoke(UpdateCommand $command): TemplateResponse
    {
        $template = $this->creator->update(
            $command->id(),
            $command->name(),
            $command->icon(),
            $command->category(),
            $command->author(),
            $command->images()
        );

        return
            new TemplateResponse(
                $template->id(),
                $template->name(),
                $template->region(),
                $template->category()->id(),
                $template->icon(),
                $template->author()->id(),
                $template->common(),
                array_map(
                    fn (TemplateImage $image) => ['id' => $image->id(), 'link' => $image->link()],
                    $template->images()->toArray()
                ),
                $template->created(),
                $template->updated()
            )
        ;
    }
}
