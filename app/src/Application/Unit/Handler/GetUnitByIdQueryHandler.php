<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Query\GetUnitByIdQuery;
use App\Application\Unit\Response\GetUnitByIdResponse;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class GetUnitByIdQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private UnitProvider $provider;

    public function __construct(UnitProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetUnitByIdQuery $query): GetUnitByIdResponse
    {
        $unit = $this->provider->get($query->getId()->toString());

        return
            new GetUnitByIdResponse(
                u($unit->id()),
                u($unit->name()),
                u($unit->shortName()),
                u($unit->region()),
                $unit->values()
            )
        ;
    }
}
