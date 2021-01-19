<?php

declare(strict_types=1);

namespace App\Application\Label\Handler;

use App\Application\Label\Provider\LabelProvider;
use App\Application\Label\Query\GetLabelQuery;
use App\Application\Label\Response\GetLabelResponse;
use App\Domain\Handler\AbstractQueryHandler;
use App\Infrastructure\Trait\ObjectAccess;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetLabelQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    use ObjectAccess;

    public function __construct(private LabelProvider $provider) {}

    public function __invoke(GetLabelQuery $query): GetLabelResponse
    {
        $label = $this->provider->get($query->id());

        $this->hasPermission($label->item()->list()->members(), $query->initiator(), $label->id());

        return new GetLabelResponse($label->id(), $label->created(), $label->updated(), $label->text());
    }
}
