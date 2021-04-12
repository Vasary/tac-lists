<?php

declare(strict_types=1);

namespace App\Application\Template\Handler\Command;

use App\Application\Template\Command\CreateCommand;
use App\Application\Template\Creator\TemplateCreator;
use App\Application\Template\Response\TemplateResponse;
use App\Domain\Template\Model\TemplateImage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateTemplateHandler implements MessageHandlerInterface
{
    public function __construct(private TemplateCreator $creator)
    {
    }

    public function __invoke(CreateCommand $command): TemplateResponse
    {
        $template = $this->creator->create(
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
