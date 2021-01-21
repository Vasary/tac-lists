<?php

declare(strict_types=1);

namespace App\Application\Template\Handler\Query;

use App\Application\Template\Provider\DataProvider;
use App\Application\Template\Query\GetTemplatesQuery;
use App\Application\Template\Response\TemplatesResponse;
use App\Application\Template\Response\TemplateResponse;
use App\Domain\Entity\Template;
use App\Domain\Entity\TemplateImage;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetAllTemplatesQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    public function __construct(private DataProvider $provider) {}

    public function __invoke(GetTemplatesQuery $query): TemplatesResponse
    {
        $templates = array_map(
            fn(Template $template) => new TemplateResponse(
                $template->id(),
                $template->name(),
                $template->region(),
                $template->category()->id(),
                $template->icon(),
                $template->author()->id(),
                $template->common(),
                array_map(fn (TemplateImage $image) => $image->id(), $template->images()->toArray()),
                $template->created(),
                $template->updated()
            ),
            $this->provider->all($query->person()),
        );

        return new TemplatesResponse($templates);
    }
}