<?php

declare(strict_types=1);

namespace App\Application\Command\Unit;

use App\Application\Command\AbstractCommandHandler;
use App\Application\Response\Unit\GetUnitByIdResponse;
use App\Application\Response\Unit\GetUnitsResponse;
use App\Domain\Entity\Unit;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetUnitsCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private UnitProvider $provider;

    public function __construct(UnitProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetUnitsCommand $command): GetUnitsResponse
    {
        $units = array_map(
            fn (Unit $unit) => new GetUnitByIdResponse(
                $unit->name(),
                $unit->shortName(),
                $unit->region(),
                $unit->values()
            ),
            $this->provider->getAll(),
        );

        return new GetUnitsResponse($units);
    }
}
