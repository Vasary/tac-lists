<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Query\UnitsQuery;
use App\Application\Unit\Response\UnitResponse;
use App\Application\Unit\Response\UnitsResponse;
use App\Domain\Unit\Model\Unit;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class UnitsQueryHandler implements MessageHandlerInterface
{
    public function __construct(private UnitProvider $provider)
    {
    }

    public function __invoke(UnitsQuery $query): UnitsResponse
    {
        $units = array_map(
            fn (Unit $unit) => new UnitResponse(
                $unit->id(),
                u($unit->name()),
                u($unit->shortName()),
                $unit->region(),
                $unit->values()
            ),
            iterator_to_array($this->provider->regional($query->initiator())),
        );

        return new UnitsResponse($units);
    }
}
