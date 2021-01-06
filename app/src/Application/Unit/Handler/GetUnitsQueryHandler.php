<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Query\GetUnitsQuery;
use App\Application\Unit\Response\GetUnitByIdResponse;
use App\Application\Unit\Response\GetUnitsResponse;
use App\Domain\Entity\Unit;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class GetUnitsQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private UnitProvider $provider;

    public function __construct(UnitProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetUnitsQuery $command): GetUnitsResponse
    {
        $units = array_map(
            fn(Unit $unit) => new GetUnitByIdResponse(
                u($unit->id()),
                u($unit->name()),
                u($unit->shortName()),
                u($unit->region()),
                $unit->values()
            ),
            $this->provider->getAll(),
        );

        return new GetUnitsResponse($units);
    }
}
