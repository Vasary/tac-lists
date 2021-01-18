<?php

declare(strict_types=1);

namespace App\Application\Template\Handler\Query;

use App\Application\Template\Provider\DataProvider;
use App\Application\Template\Query\GetAllQuery;
use App\Application\Template\Response\AllTemplatesResponse;
use App\Application\Template\Response\TemplateResponse;
use App\Domain\Entity\Template;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetAllTemplatesQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private DataProvider $provider;

    public function __construct(DataProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetAllQuery $query): AllTemplatesResponse
    {
        $templates = array_map(
            fn(Template $template) => new TemplateResponse(
                $template->id(),
                $template->region(),
                $template->category()->id(),
                $template->icon(),
                $template->author()->id(),
                $template->common(),
                $template->images()->toArray(),
                $template->created(),
                $template->updated()
            ),
            $this->provider->all(),
        );

        return new AllTemplatesResponse($templates);
    }
}