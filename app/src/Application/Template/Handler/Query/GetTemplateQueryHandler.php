<?php

declare(strict_types=1);

namespace App\Application\Template\Handler\Query;

use App\Application\Template\Provider\DataProvider;
use App\Application\Template\Query\GetTemplateQuery;
use App\Application\Template\Response\TemplateResponse;
use App\Domain\Entity\TemplateImage;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetTemplateQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    public function __construct(private DataProvider $provider)
    {
    }

    public function __invoke(GetTemplateQuery $query): TemplateResponse
    {
        $template = $this->provider->get($query->id(), $query->person());

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
