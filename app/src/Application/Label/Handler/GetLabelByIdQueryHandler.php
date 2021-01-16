<?php

declare(strict_types=1);

namespace App\Application\Label\Handler;

use App\Application\Label\Provider\LabelProvider;
use App\Application\Label\Query\GetLabelByIdQuery;
use App\Application\Label\Response\GetLabelResponse;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class GetLabelByIdQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private LabelProvider $provider;

    public function __construct(LabelProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetLabelByIdQuery $query): GetLabelResponse
    {
        $label = $this->provider->get($query->getId()->toString());

        return
            new GetLabelResponse(
                u($label->id()->__toString()),
                $label->created(),
                $label->updated(),
                u($label->text())
            );
    }
}
