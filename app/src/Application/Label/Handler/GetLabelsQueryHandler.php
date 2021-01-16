<?php

declare(strict_types=1);

namespace App\Application\Label\Handler;

use App\Application\Label\Provider\LabelProvider;
use App\Application\Label\Query\GetLabelsQuery;
use App\Application\Label\Response\GetLabelResponse;
use App\Application\Label\Response\GetLabelsResponse;
use App\Domain\Entity\Label;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class GetLabelsQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private LabelProvider $provider;

    public function __construct(LabelProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetLabelsQuery $query): GetLabelsResponse
    {
        $labels = array_map(
            fn(Label $label) => new GetLabelResponse(
                u($label->id()),
                $label->created(),
                $label->updated(),
                u($label->text()),
            ),
            $this->provider->getAll(),
        );

        return new GetLabelsResponse($labels);
    }
}
