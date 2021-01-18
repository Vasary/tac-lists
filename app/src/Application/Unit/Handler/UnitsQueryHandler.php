<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Query\UnitsQuery;
use App\Application\Unit\Response\UnitResponse;
use App\Application\Unit\Response\UnitsResponse;
use App\Domain\Entity\Unit;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class UnitsQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    public function __construct(private UnitProvider $provider) {}

    public function __invoke(UnitsQuery $command): UnitsResponse
    {
        $units = array_map(
            fn(Unit $unit) => new UnitResponse(
                $unit->id(),
                u($unit->name()),
                u($unit->shortName()),
                $unit->region(),
                $unit->values()
            ),
            $this->provider->all(),
        );

        return new UnitsResponse($units);
    }
}
